<?php

namespace App\Actions\Listing;

use App\Actions\GeoCoding\GetGeoCodeAddress;
use App\Models\Feature;
use App\Models\Listing;

class UpdateListing
{
    public function execute(Listing $listing, array $request)
    {
        $this->validate($request);

        if (key_exists('features', $request)) {
            $listing->features()->sync(collect($request['features'])->map(function ($feature) {
                return Feature::where('name', 'LIKE', '%' . $feature . '%')->firstOrCreate(['name' => $feature])->id;
            }));

            unset($request['features']);
        }

        if (isset($request['media'])) {
            $listing->syncFromMediaLibraryRequest($request['media'])
                ->toMediaCollection('images');
        }

        if (key_exists('asking_price', $request)) {
            $request['asking_price'] = (float) str_replace(',', '',$request['asking_price']);
        }

        $listing->update($request);

        $location = (new GetGeoCodeAddress())->execute($listing->addressString());

        if ($location) {
            $listing->update([
                'latitude' => $location['lat'],
                'longitude' => $location['lon']
            ]);
        }

        return tap($listing)->fresh();
    }

    private function validate(array $request)
    {
        return \Validator::validate($request, [
            'address_line_one' => ['sometimes', 'required'],
            'address_line_two' => ['sometimes', ''],
            'postcode' => ['sometimes','required'],
            'province' => ['sometimes','required'],
            'city' => ['sometimes','required'],
            'property_type' => ['sometimes','required'],
            'property_size' => ['sometimes','required'],
            'land_size' => ['sometimes','required'],
            'bedrooms' => ['sometimes','required'],
            'bathrooms' => ['sometimes','required'],
            'description' => ['sometimes','required'],
            'specification' => ['sometimes','required'],
            'user_id' => ['sometimes', 'required']
        ]);
    }
}
