<?php

namespace App\Services;

use App\Repositories\UKBankAccountRepository;
use App\Jobs\MapUKBankAccountChunkJob;
class UKBankAccountService extends BaseUKService
{
    public function __construct(protected UKBankAccountRepository $ukBankAccountRepository)
    {
        parent::__construct(
            $ukBankAccountRepository,
            MapUKBankAccountChunkJob::class,
            'BankAccountID',
            5000,
            'bank-account'
        );
    }

}