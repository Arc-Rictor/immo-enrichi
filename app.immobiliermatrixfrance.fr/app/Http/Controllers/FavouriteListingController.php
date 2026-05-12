<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFavouriteListingRequest;
use App\Http\Requests\UpdateFavouriteListingRequest;
use App\Models\FavouriteListing;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class FavouriteListingController extends Controller
{

    public function __invoke(Request $request)
    {
        $user = auth()->user();
        $listing = Listing::find($request->listing);
        $this->toggleFavouriteListing($user, $listing);

        return redirect()->back()->with('success', 'Favourite status toggled successfully!');
    }

    public function toggleFavouriteListing(User $user, Listing $listing)
    {
        // If the user has already favourited the listing
        if ($user->favouriteListings()->where('listing_id', $listing->id)->exists()) {
            // Remove the favourite listing
            $user->favouriteListings()->detach($listing->id);
        } else {
            // Add the listing to favourites
            $user->favouriteListings()->attach($listing->id);
        }
    }
}
