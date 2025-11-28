<?php

namespace App\Actions\Listing;

use App\Actions\GeoCoding\CalculateDistance;
use App\Models\Listing;

class GetSimilarListings
{
    public function execute($location)
    {
        $listings = Listing::where('status', 'published')->where('id', '!=', $location->id)->get();

        return $listings->filter(function ($listing) use ($location) {
            $distance = (new CalculateDistance())->execute(
                $location->latitude, $location->longitude,
                $listing->latitude, $listing->longitude
            );

            return $distance <= 20;
        });

    }
}
