<?php

namespace App\Console\Commands;

use App\Models\Airport;
use App\Models\AirportGlobal;
use Illuminate\Console\Command;
use Spatie\Geocoder\Geocoder;


class SyncAirports extends Command
{
    protected $signature = 'sync:airports';

    protected $description = 'Sync airports';

    public function handle()
    {
        $airports = Airport::all();

        foreach ($airports as $airport) {

            $result = AirportGlobal::where('iata_code', $airport->iata)->first();

            if($result) {

                $address = $this->addressFromCoordinates($result->latitude_deg, $result->longitude_deg);

                $airport->latitude = $result->latitude_deg;
                $airport->longitude = $result->longitude_deg;
                $airport->address_text = $address;

                $airport->gat_latitude = $result->latitude_deg;
                $airport->gat_longitude = $result->longitude_deg;
                $airport->gat_address_text = $address;

                $airport->save();
            }
        }

    }

    private function addressFromCoordinates($lat, $lng)
    {
        $client = new \GuzzleHttp\Client();
        $geocoder = new Geocoder($client);
        $geocoder->setApiKey(config('geocoder.key'));

        $zip = false;

        $result = $geocoder->getAddressForCoordinates($lat, $lng);

        return $result['formatted_address'];

        /*foreach ($result['address_components'] as $component) {

            $type = $component->types[0];

            if($type === 'postal_code') {
                $zip = $component->long_name;
            }

        }

        return $zip;*/
    }

}
