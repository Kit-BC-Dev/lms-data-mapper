<?php

namespace App\Jobs;

use App\Services\CardService;
use App\Services\ClientAddressBookService;
use App\Services\ClientService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class MapCSVAddressBookChunkJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $rows)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(
        ClientService $clientService,
        ClientAddressBookService $clientAddressBookService,
        CardService $cardService
    ): void
    {
        $clientNames = [];
        $cardNumbers = [];
        
        foreach ($this->rows as $row) {
            if (!in_array($row['Owner_AccountName'], $clientNames)) {
                $clientNames[] = $row['Owner_AccountName'];
            }

            if (!in_array($row['AccountOrCardNumber'], $cardNumbers)) {
                $cardNumbers[] = substr($row['AccountOrCardNumber'], 6);
            }
        }
        $clients = $clientService->getClientByFirstName($clientNames)
        ->mapWithKeys(fn ($client) => [
            $client->FirstName => [
                'AccountClientID' => $client->ClientID,
                'PersonClientID' => $client->ParentClientID
            ]
        ]);

        $cards = $cardService->getByCardNumber($cardNumbers)->mapWithKeys(fn ($card) => [
            $card->CardNumber => [
                'AccountClientID' => $card->AccountClientID,
                'accountNumber' => $card->accountClient->AccountNumber,
            ]
        ]);
        
        foreach ($this->rows as $row) {
            
            $accountNumber = substr($row['AccountOrCardNumber'], 6);
            $isCard = isset($cards[$accountNumber]);
            $clientAddressBooks[] = [
                'ExternalReference' => 'AddressBook_' . $row['Id'],
                'AccountClientID' => $clients[strtoupper($row['Owner_AccountName'])]['AccountClientID'] ?? 0,
                'PersonClientID' => $clients[strtoupper($row['Owner_AccountName'])]['PersonClientID'] ?? 0,
                'OtherPartyNickName' => $row['MemberName'],
                'OtherPartyAccountNumber' => !$isCard ? $accountNumber : $cards[$accountNumber]['accountNumber'],
                'OtherPartyCardNumber' => $isCard ? $accountNumber : null,
                'OtherPartyRelationship' => $row['AddressBookTypeId'] == 1 ? 'Merchant' : 'Customer',
                'CreatedBy' => 'migration',
                'ModifiedBy' => 'migration',

            ];
        }
        $clientAddressBookService->create($clientAddressBooks);
            
    }
}
