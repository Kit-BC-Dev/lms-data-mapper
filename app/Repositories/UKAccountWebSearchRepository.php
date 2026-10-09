<?php

namespace App\Repositories;

use App\Models\Accounts\AccountWebSearch;

class UKAccountWebSearchRepository extends BaseUKRepository
{
    
    public function __construct(
        private AccountWebSearch $accountWebSearch
    ) {
        parent::__construct(
            $accountWebSearch,
            'AccountID'
        );
    }

    public function getDemographicsToMap()
    {
        return $this->accountWebSearch
            ->select('Brokerage')
            ->distinct()
            ->whereNotNull('Brokerage')
            ->whereNotIn('Brokerage', [
                'Bartercard Administration',
                'zThames Valley South',
                'zCornwall & Devon',
                'zEssex',
                'zMilton Keynes',
                'zSlough',
                'Bartercard Client Services',
                'zCentral Counties',
                'zBartercard South East',
                'zYork & The North',
                'zBournemouth',
                'Bartercard Basingstoke',
                'zBirmingham Nth East',
                'zRomford',
                'Bartercard Sports Clubs',
                'zMidlands',
                'zBartercard Scotland',
            ])
            ->pluck('Brokerage');
    }

    public function getSourcesToMap()
    {
        return $this->accountWebSearch
            ->select('Broker')
            ->distinct()
            ->whereNotNull('Broker')
            ->pluck('Broker');
    }
}