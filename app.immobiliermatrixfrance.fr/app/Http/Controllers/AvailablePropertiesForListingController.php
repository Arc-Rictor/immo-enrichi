<?php

namespace App\Http\Controllers;

use App\Http\Resources\ListingResource;
use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AvailablePropertiesForListingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Listing/ListingAvailableIndex', [
            'listings' => ListingResource::collection(Listing::whereNull('agent_id')->where('status', 'draft')->get())
        ]);
    }
}
