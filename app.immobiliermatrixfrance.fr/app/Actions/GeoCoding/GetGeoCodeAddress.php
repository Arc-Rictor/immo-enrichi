<?php

namespace App\Actions\GeoCoding;

class GetGeoCodeAddress
{
    public function execute($address)
    {
        $address = urlencode($address);

        $apiKey = config('app.google_maps_api_key');

        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=$apiKey";
        $response = \Http::get($url);
        $data = $response->json();

        $lat = $data['results'][0]['geometry']['location']['lat'];
        $lon = $data['results'][0]['geometry']['location']['lng'];

        return ['lat' => $lat, 'lon' => $lon];
    }
}
