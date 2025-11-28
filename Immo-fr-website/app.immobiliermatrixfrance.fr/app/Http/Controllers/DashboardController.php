<?php

namespace App\Http\Controllers;

use App\Http\Resources\ListingResource;
use App\Models\FavouriteListing;
use App\Models\Listing;
use App\Models\RecentlyViewedListing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function __invoke()
    {

        return Inertia::render('Dashboard/Dashboard', [
            'property_stats' => $this->propertyStats(),
            'recently_viewed' => ListingResource::collection($this->recentlyViewed()),
            'favourite_properties' => ListingResource::collection(auth()->user()->favouriteListings),
            'unpublished_listings_count' => auth()->user()->type === 'agent'
                ? Listing::where('agent_id', auth()->user()->agent->id)->where('status', '!=', 'published')->count()
                : null,
            'available_count' => Listing::whereNull('agent_id')->count()
        ]);
    }

    private function propertyStats()
    {
        return auth()->user()->type === 'buyer'
            ? $this->buyerPropertyStats()
            : $this->agentSellerPropertyStats();
    }

    private function buyerPropertyStats()
    {
        return [
            [
                'name' => 'Your saved properties',
                'current' => FavouriteListing::where('user_id', auth()->user()->id)->count(),
                'change' => '10%',
                'changeType' => 'increase',
                'colour' => 'blue'

            ],
            [
                'name' => 'New listings added this week',
                'current' => Listing::where('published_at', '>', Carbon::now()->subWeek())->where('status', 'published')->count(),
                'change' => '10%',
                'changeType' => 'increase',
                'colour' => 'purple'

            ],
            [
                'name' => 'New listings added last 30 days',
                'current' => Listing::where('published_at', '>', Carbon::now()->subDays(30))->where('status', 'published')->count(),
                'change' => '10%',
                'changeType' => 'increase',
                'colour' => 'orange'

            ]
        ];

    }

    private function agentSellerPropertyStats()
    {
        return [
            [
                'name' => 'Sold Properties',
                'current' => 0,
                'change' => '5%',
                'changeType' => 'increase',
                'colour' => 'orange'
            ],
            [
                'name' => 'Your saved properties',
                'current' => FavouriteListing::where('user_id', auth()->user()->id)->count(),
                'change' => '10%',
                'changeType' => 'increase',
                'colour' => 'blue'

            ],
            [
                'name' => 'New listings added this week',
                'current' => Listing::where('created_at', '>', Carbon::now()->subWeek())->count(),
                'change' => '10%',
                'changeType' => 'increase',
                'colour' => 'purple'

            ]
        ];
    }

    private function recentlyViewed()
    {
        $listings = collect();

        foreach (RecentlyViewedListing::where('user_id', auth()->user()->id)->get() as $viewed) {
            $listing = Listing::find($viewed['listing_id']);
if($listing){
            if ($listing->status === 'published') {
                $listings->push($listing);
            }
        }
    }

        return $listings;
    }

}
