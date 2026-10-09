<?php

namespace App\Jobs;

use App\Services\CardService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

use App\Repositories\UKCardRepository;

class MapUkCardChunkJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $ids, private int $total)
    {
        //
    }


    /**
     * Execute the job.
     */
    public function handle(
        UKCardRepository $ukCardRepository,
        CardService $cardService
    ): void
    {
        $cards = $ukCardRepository->getChunk($this->ids);
        foreach ($cards as $card) {
            $cardData['cards'][] = $card->toArray();
            $cardData['Accounts'][] = 'Account_' . $card->AccountFK;
            $cardData['Person'][] = 'Person_' . $card->PersonFK;
        }
        
        logger()->info('Progress', [
            'mapped_so_far' => $this->total,
            'table' => 'cards',
        ]);
        
        $cardService->create($cardData);
    }
}
