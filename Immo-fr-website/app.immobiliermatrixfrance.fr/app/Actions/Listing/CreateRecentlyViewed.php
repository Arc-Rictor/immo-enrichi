<?php

namespace App\Actions\Listing;

use App\Models\RecentlyViewedListing;
use App\Models\User;

class CreateRecentlyViewed
{
    public function execute(User $user, $listing)
    {
        if ($user->recentlyViewed()->where('listing_id', $listing->id)->exists()) {
            $user->recentlyViewed()->sync($listing->id);
        } else {
            $user->recentlyViewed()->attach($listing->id);
        }
    }
}
