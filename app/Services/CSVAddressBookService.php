<?php

namespace App\Services;

use App\Jobs\MapCSVAddressBookChunkJob;

class CSVAddressBookService
{
    public function doMap()
    {
        $path = public_path('csv/addressbook.csv');

        $file = fopen($path, 'r');

        $headers = fgetcsv($file);

        $headers = array_map(
            fn ($header) => preg_replace('/^\xEF\xBB\xBF/', '', $header),
            $headers
        );

        $batch = [];
        $batchSize = 1000;

        while(($row = fgetcsv($file)) !== false) {
            $batch[] = array_combine($headers, $row);

            if (count($batch) === $batchSize) {
                MapCSVAddressBookChunkJob::dispatch($batch)->onQueue('address-book');
                $batch = [];
            }
        }

        if (!empty($batch)) {
            MapCSVAddressBookChunkJob::dispatch($batch)->onQueue('address-book');
        }

        fclose($file);
    }
}