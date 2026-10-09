<?php

namespace App\Pipelines;

use App\Mapper\AccountMapper;
use App\Services\AddressService;
use App\Services\ClientService;
use Closure;

use App\Traits\DataMapper;
class AccountPipeline
{
    use DataMapper;
    public function __construct(
        private AccountMapper $accountMapper,
        private ClientService $clientService,
        private AddressService $addressService
    ){}

    public function handle($data, Closure $next)
    {
       $accountIDs = $data->pluck('AccountID')
                    ->filter(fn ($id) => $id != 0)
                    ->unique()
                    ->values()
                    ->map(fn ($id, $index) => "Account_" . $id)
                    ->toArray();

        $addressIDs = $data->pluck('MainLocationFK')
                    ->filter(fn ($id) => $id != 0)
                    ->unique()
                    ->values()
                    ->toArray();

        $addresses =  $this->addressService->getByIDs($addressIDs)->mapWithKeys(fn ($address) => [
            'Address_' . $address->ExternalReference => [
                'AddressID' => $address->AddressID,
            ],
        ])->all();


        foreach ($data as $account) {
            $dto = $this->accountMapper->map(array_merge($account->toArray(), [
                'ClientTypeID' => 1,
                'PrimaryAddressID' => $addresses['Address_' . $account->MainLocationFK]['AddressID'] ?? null,
            ]));
            $accounts[] = $dto->toArray();
            $accountsSource[] = $account;
        }

        $this->clientService->create($accounts);

        $createdAccounts = $this->clientService->getByExternalApiRefs($accountIDs, 'mysql_staging');
        $data['mapped_accounts'] = $this->doMapAccount($createdAccounts);
        $data['accounts'] = $accountsSource;
        
        return $next($data);
    }
}