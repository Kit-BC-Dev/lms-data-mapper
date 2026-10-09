<?php

namespace App\Console\Commands;

use App\Models\ClientDirectory\ClientDirectory;
use App\Models\ClientDirectory\ClientDirectoryReferencePoint;
use App\Repositories\ClientRepository;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

#[Signature('app:generate-outlet-coordinates')]
#[Description('Generate coordinates for outlet clients using LocationIQ')]
class GenerateOutletCoordinates extends Command
{
    private const LOCATION_IQ_LIMIT = 5000;

    public function __construct(
        private ClientRepository $clientRepository,
        private ClientDirectoryReferencePoint $clientDirectoryReferencePoint,
        private ClientDirectory $clientDirectory
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $totalOutlets = $this->clientRepository->getTotalOutletClient();

        $totalProcessed = 0;

        // Number of LocationIQ calls already used
        $totalProcessedByAPI = 0;

        $this->info("Total outlets to process: {$totalOutlets}");
        $this->info(
            "LocationIQ API usage: {$totalProcessedByAPI}/" .
            self::LOCATION_IQ_LIMIT
        );

        $this->newLine();

        /*
         * Overall outlet progress
         */
        $outletProgress = $this->output->createProgressBar($totalOutlets);

        $outletProgress->setFormat(
            'Processed outlets: %current%/%max% [%bar%] %percent:3s%%'
        );

        $outletProgress->start();

        $this->newLine();

        /*
         * LocationIQ API progress
         */
        $apiProgress = $this->output->createProgressBar(
            self::LOCATION_IQ_LIMIT
        );

        $apiProgress->setFormat(
            'LocationIQ API: %current%/%max% [%bar%] %percent:3s%%'
        );

        /*
         * Start the progress bar at the number of calls
         * that have already been used.
         */
        $apiProgress->setProgress($totalProcessedByAPI);

        $apiProgress->start();

        $this->newLine(2);

        /*
         * Process outlets
         */
        $this->clientRepository->getOutletClient(
            1000,
            function ($outlets) use (
                &$totalProcessed,
                &$totalProcessedByAPI,
                $outletProgress,
                $apiProgress
            ) {
                foreach ($outlets as $outlet) {

                    /*
                     * Update outlet progress
                     */
                    $totalProcessed++;
                    $outletProgress->advance();

                    /*
                     * Stop making API requests once the limit is reached.
                     */
                    if ($totalProcessedByAPI >= self::LOCATION_IQ_LIMIT) {
                        continue;
                    }

                    $outletAddress = $outlet->address;
                    $spiel = $outlet->spiel;

                    if (!$spiel) {
                        continue;
                    }

                    $clientDirectory = $this->clientDirectory->getOutletDirectory(
                        $spiel->ClientDirectorySpielID,
                        $outlet->ParentClientID
                    );

                    if (!$clientDirectory) {
                        continue;
                    }

                    $outletRef = $this->clientDirectoryReferencePoint
                        ->getClientDirectoryReferencePoint(
                            $outlet->ClientID,
                            $outlet->ParentClientID,
                            $clientDirectory->ClientDirectoryID
                        );

                    /*
                     * Already has coordinates
                     */
                    if ($outletRef) {
                        continue;
                    }

                    if (!$outletAddress) {
                        continue;
                    }

                    /*
                     * Clean street address
                     */
                    $street = preg_replace(
                        '/^\S+\s+\s*/',
                        '',
                        preg_replace(
                            '/^C\/-\s*Bartercard\s*Uk\s*/i',
                            '',
                            $outletAddress->Address
                        )
                    );

                    /*
                     * Build address
                     */
                    $address = collect([
                        $street,
                        $outletAddress->City,
                        $outletAddress->Suburb,
                        $outletAddress->PostCode,
                        $outletAddress->Country ?: 'United Kingdom',
                    ])
                        ->filter()
                        ->implode(', ');

                    if (blank($address)) {
                        continue;
                    }

                    /*
                     * LocationIQ API
                     */
                    $response = Http::timeout(5)->get(
                        'https://us1.locationiq.com/v1/search',
                        [
                            'key' => config('services.locationiq.key'),
                            'q' => $address,
                            'format' => 'json',
                            'limit' => 1,
                        ]
                    );

                    /*
                     * Count every API request made.
                     */
                    $totalProcessedByAPI++;

                    /*
                     * Update API progress bar immediately after
                     * making the request.
                     */
                    $apiProgress->setProgress(
                        $totalProcessedByAPI
                    );

                    if ($response->successful()) {

                        $result = $response->json();

                        if (!empty($result[0])) {

                            $this->clientDirectoryReferencePoint->insert([
                                'ClientDirectoryID' =>
                                    $clientDirectory->ClientDirectoryID,

                                'OutletClientID' =>
                                    $outlet->ClientID,

                                'AccountClientID' =>
                                    $outlet->ParentClientID,

                                'ReferencePoint' => DB::raw(
                                    "ST_SRID(
                                        POINT(
                                            {$result[0]['lon']},
                                            {$result[0]['lat']}
                                        ),
                                        4326
                                    )"
                                ),
                            ]);

                        } else {

                            Log::channel('geocoding')->info(
                                'LocationIQ returned no result',
                                [
                                    'address' => $address,
                                    'client_id' => $outlet->ClientID,
                                ]
                            );
                        }

                    } else {

                        Log::channel('geocoding')->error(
                            'Outlet geocoding request failed',
                            [
                                'client_id' =>
                                    $outlet->ClientID,

                                'parent_client_id' =>
                                    $outlet->ParentClientID,

                                'address' => $address,

                                'status' =>
                                    $response->status(),
                            ]
                        );
                    }
                }
            }
        );

        /*
         * Finish progress bars
         */
        $outletProgress->finish();

        $this->newLine();

        $apiProgress->finish();

        $this->newLine(2);

        /*
         * Final statistics
         */
        $percentage = $totalOutlets > 0
            ? round(
                ($totalProcessed / $totalOutlets) * 100,
                2
            )
            : 0;

        $this->info(
            "Finished. Processed {$totalProcessed}/{$totalOutlets} outlets ({$percentage}%)."
        );

        $this->info(
            "LocationIQ API usage: {$totalProcessedByAPI}/" .
            self::LOCATION_IQ_LIMIT
        );

        return self::SUCCESS;
    }
}