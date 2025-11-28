<?php

namespace App\Http\Controllers;

use App\Http\Resources\ListingResource;
use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AgentListingInterestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Listing $listing)
    {
        return Inertia::render('Listing/ListingAgentInterestIndex', [
            'listing' => ListingResource::make($listing->load('interest'))
        ]);
    }
}
