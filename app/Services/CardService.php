<?php

namespace App\Services;

use App\Mapper\CardMapper;
use App\Repositories\CardRepository;
use App\Services\ClientService;
use App\Traits\DataMapper;
use DB;
use finfo;
class CardService
{
    use DataMapper;
    private $newAccounts;
    private $newPeople;
    public function __construct(
        protected CardRepository $cardRepository,
        protected ClientService $clientService,
        protected CardMapper $cardMapper
    ){}

    public function create(array $data)
    {
        DB::connection('mysql_staging')->transaction(function () use ($data) {

            $cards = [];
            self::mapAccountAndPerson($data);
            foreach ($data['cards'] as $card) {
                $dto = $this->cardMapper->map(
                    $card,
                    $this->newAccounts['Account_' . $card['AccountFK']]['AccountID'],
                    $this->newPeople['Person_' . $card['PersonFK']]['PersonID']
                );

                $cards[] = $dto->toArray();
            }

            $this->cardRepository->updateOrCreate($cards);
        });
    }

    public function getByExternalReference(array $references)
    {
        return $this->cardRepository->getByExternalReference($references);
    }

    private function mapAccountAndPerson(array $data)
    {

        $this->newAccounts = $this->doMapAccount($this->clientService->getByExternalApiRefs($data['Accounts'])->keyBy('ExternalAPIRef'));

        $this->newPeople = $this->doMapPeople($this->clientService->getByExternalApiRefs($data['Person'])->keyBy('ExternalAPIRef'));
    }

    public function getByCardNumber(array $cardNumbers)
    {
        return $this->cardRepository->getByCardNumber($cardNumbers);
    }
}