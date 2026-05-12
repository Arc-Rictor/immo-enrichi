<?php

namespace App\Actions\GeoCoding;

class CalculateDistance
{
    public function execute($lat1, $lon1, $lat2, $lon2)
    {
        // The Haversine formula is used to calculate the distance between two points on a sphere (like the Earth)
        // given their latitude and longitude coordinates. The formula is based on trigonometric functions
        // and takes into account the curvature of the Earth.

        // Earth's radius in kilometers
        $earthRadius = 6371;

        $deltaLat = deg2rad($lat2 - $lat1);
        $deltaLon = deg2rad($lon2 - $lon1);

        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }
}
