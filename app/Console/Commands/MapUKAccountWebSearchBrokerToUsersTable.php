<?php

namespace App\Console\Commands;

use App\Services\UKAccountWebSearchService;
use App\Services\UserService;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:map-source-to-user')]
#[Description('Command description')]
class MapUKAccountWebSearchBrokerToUsersTable extends Command
{
    public function __construct(
        private UKAccountWebSearchService $uKAccountWebSearchService, 
        private UserService $userService
    ){
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $brokers = $this->uKAccountWebSearchService->getSourcesToMap();

        foreach ($brokers as $broker) {
            $users[] = [
                'ExternalReference' => 'Broker_' . $broker,
                'FirstName' => $broker,
                'UserName' => $broker,
                'Active' => 1
            ];
        }

        $this->userService->create($users);
    }
}
