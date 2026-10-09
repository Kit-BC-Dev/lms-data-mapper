<?php

namespace App\Console\Commands;

use App\Services\CSVAddressBookService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-client-address-book')]
#[Description('Command description')]
class MapClientAddressBookFromCSV extends Command
{
    public function __construct(private CSVAddressBookService $cSVAddressBookService)
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Mapping CSV address book to Client Address Book Table");

        $this->cSVAddressBookService->doMap();

        $this->info("DONE! DONE! DONE! DONE!");
    }
}
