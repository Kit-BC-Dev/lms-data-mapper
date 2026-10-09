<?php

namespace App\Services;

class AddressParserService
{
    function parseUKAddress(?string $addressLine1, ?string $addressLine2): array
    {
        $streetTypes = [
            'RD' => 'Road',
            'ROAD' => 'Road',
            'ST' => 'Street',
            'STREET' => 'Street',
            'AVE' => 'Avenue',
            'AVENUE' => 'Avenue',
            'LN' => 'Lane',
            'LANE' => 'Lane',
            'CL' => 'Close',
            'CLOSE' => 'Close',
            'DR' => 'Drive',
            'DRIVE' => 'Drive',
            'WAY' => 'Way',
        ];

        $result = [
            'AddressName' => null,
            'UnitNumber' => null,
            'StreetNumber' => null,
            'Address' => null,
            'StreetType' => null,
        ];

        $addressLine1 = trim($addressLine1 ?? '');
        $addressLine2 = trim($addressLine2 ?? '');

        if ($addressLine2 !== '') {
            $result['AddressName'] = $addressLine1;
            $street = $addressLine2;
        } else {
            $street = $addressLine1;
        }

        if (preg_match('/^([\dA-Za-z\-\/]+)\s+(.*)$/', $street, $matches)) {
            $result['StreetNumber'] = strtoupper($matches[1]);
            $street = $matches[2];
        }

        $parts = preg_split('/\s+/', $street);

        if (!empty($parts)) {
            $last = strtoupper(end($parts));

            if (isset($streetTypes[$last])) {
                $result['StreetType'] = $streetTypes[$last];
                array_pop($parts);
            }

            $result['Address'] = implode(' ', $parts);
        }

        return $result;
    }

}