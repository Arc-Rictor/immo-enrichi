<?php

namespace App\Http\Controllers;

use App\Actions\GeoCoding\CalculateDistance;
use App\Actions\GeoCoding\GetGeoCodeAddress;
use App\Http\Resources\ListingResource;
use App\Models\Feature;
use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Laravel\Fortify\Features;

class PropertySearchController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $properties = null;
        if ($request->has('location') && $request->get('location') !== null) {
            $properties = $this->search($request->all());
        }

        return Inertia::render('Search/SearchIndex', [
            'listings' => $properties != null ? ListingResource::collection($properties[0]) : null,
            'filters' => [
                'features' => Feature::all()->pluck('name'),
            ],
            'searchData' => $request->all(),
            'location' => $properties[1] ?? null
        ]);
    }

    private function search($request)
    {
        $properties = Listing::published()->get();

        $location = (new GetGeoCodeAddress())->execute($request['location']);

        $properties = $properties->map(function ($property) use ($location) {
            $property->distance = (new CalculateDistance())->execute(
                $property['latitude'],
                $property['longitude'],
                $location['lat'],
                $location['lon']
            );
            return $property;
        });

        $properties = $properties->filter(function ($property) use ($request) {
            return $property->distance <= $request['radius'];
        });

        if (isset($request['bedrooms_min']) && $request['bedrooms_min'] > 0) {
            $properties = $properties->filter(function ($property)  use ($request) {
                return $property->bedrooms >= $request['bedrooms_min'];
            });
        }

        if (isset($request['bedrooms_max']) && $request['bedrooms_max'] > 0) {
            $properties = $properties->filter(function ($property)  use ($request) {
                return $property->bedrooms <= $request['bedrooms_max'];
            });
        }

        if(isset($request['bathrooms_min']) && $request['bathrooms_min'] > 0) {
            $properties = $properties->filter(function ($property) use ($request) {
               return $property->bathrooms >= $request['bathrooms_min'];
            });
        }

        if(isset($request['bathrooms_max']) && $request['bathrooms_max'] > 0) {
            $properties = $properties->filter(function ($property) use ($request) {
                return $property->bathrooms <= $request['bathrooms_max'];
            });
        }

        if (isset($request['price_min']) && $request['price_min'] > 0) {
            $properties = $properties->filter(function ($property)  use ($request) {
                return $property->asking_price >= $request['price_min'];
            });
        }

        if (isset($request['price_max']) && $request['price_max'] > 0) {
            $properties = $properties->filter(function ($property)  use ($request) {
                return $property->asking_price <= $request['price_max'];
            });
        }

        if (isset($request['property_size_min']) && $request['property_size_min'] > 0) {
            $properties = $properties->filter(function ($property)  use ($request) {
                return $property->property_size >= $request['property_size_min'];
            });
        }

        if (isset($request['property_size_max']) && $request['property_size_max'] > 0) {
            $properties = $properties->filter(function ($property)  use ($request) {
                return $property->property_size <= $request['property_size_max'];
            });
        }

        if (isset($request['land_size_min']) && $request['land_size_min'] > 0) {
            $properties = $properties->filter(function ($property)  use ($request) {
                return $property->land_size >= $request['land_size_min'];
            });
        }

        if (isset($request['land_size_max']) && $request['land_size_max'] > 0) {
            $properties = $properties->filter(function ($property)  use ($request) {
                return $property->land_size <= $request['land_size_max'];
            });
        }

        return [$properties, $location];
    }
}
