<?php

namespace App\Actions\Listing;

use App\Models\Feature;
use App\Models\Listing;

class CreateListing
{
    public function execute(array $request)
    {
        $this->validate($request);

        $listing = Listing::create([
            'reference' => random_int(10000000, 99999999),
            'user_id' => \Auth::user()->id,
            'agent_id' => \Auth::user()->type === 'agent' ? \Auth::user()->agent->id : null,
            'address_line_one' => $request['address_line_one'] ?? '',
            'address_line_two' => $request['address_line_two'] ?? '',
            'postcode' => $request['postcode']  ?? '',
            'province' => $request['province'],
            'city' => $request['city'],
            'country' => 'France',
            'property_type' => $request['property_type'],
            'property_size' => $request['property_size'],
            'land_size' => $request['land_size'],
            'bedrooms' => $request['bedrooms'],
            'bathrooms' => $request['bathrooms'],
            'description' => $request['description'],
            'specification' => $request['specification'],
            'asking_price' => $request['asking_price'],
            'status' => 'pending'
        ]);

        if (key_exists('features', $request)) {
            $listing->fresh()->features()->sync(collect($request['features'])->map(function ($feature) {
                return Feature::where('name', 'LIKE', '%' . $feature . '%')->firstOrCreate(['name' => $feature])->id;
            }));
        }

        return tap($listing)->fresh();
    }

    protected function validate(array $request)
    {
        return \Validator::validate($request, [
            'address_line_one' => [''],
            'address_line_two' => [''],
            'postcode' => [''],
            'province' => ['required'],
            'city' => ['required'],
            'property_type' => ['required'],
            'property_size' => ['required'],
            'land_size' => ['required'],
            'bedrooms' => ['required'],
            'bathrooms' => ['required'],
            'user_id' => ['']
        ]);
    }
}
