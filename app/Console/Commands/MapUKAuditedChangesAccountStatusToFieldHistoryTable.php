<?php

namespace App\Console\Commands;

use App\Services\UKAuditedChangesService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-audited-changes')]
#[Description('Command description')]
class MapUKAuditedChangesAccountStatusToFieldHistoryTable extends Command
{
    public function __construct(private UKAuditedChangesService $uKAuditedChangesService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mapping UK Account Status Audited Changes to Field History table...');
        $this->uKAuditedChangesService->doMap();

        $this->info('Mapping completed.');
        return self::SUCCESS;
    }
}
