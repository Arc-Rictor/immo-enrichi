<?php

namespace App\Http\Controllers;

use App\Actions\Listing\CreateListing;
use App\Actions\Listing\CreateRecentlyViewed;
use App\Actions\Listing\GetAvailableListingsForAgents;
use App\Actions\Listing\GetListingInterestForUsersProperties;
use App\Actions\Listing\GetListingsForUser;
use App\Actions\Listing\GetSimilarListings;
use App\Actions\Listing\IncrementViews;
use App\Actions\Listing\PublishOrUnPublishListing;
use App\Actions\Listing\UpdateListing;
use App\Http\Resources\FeatureResource;
use App\Http\Resources\ListingResource;
use App\Models\Feature;
use App\Models\Listing;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->type === 'buyer') {
            abort(404);
        }

        return Inertia::render('Listing/ListingIndex', [
            'listings' => ListingResource::collection((new GetListingsForUser)->execute(auth()->user())),
            'availableListings' => ListingResource::collection((new GetAvailableListingsForAgents())->execute(auth()->user())),
            'listingInterest' => (new GetListingInterestForUsersProperties())->execute(auth()->user()),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Listing/ListingCreate', [
            'features' => FeatureResource::collection(Feature::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, CreateListing $createListing)
    {
        $createListing->execute($request->all());

        if (auth()->user()->type === 'seller') {
            $message = "Your property has been saved, and is now available for agents to view and register their interest. Simply click 'Agent Interest' below to view and accept their invitations to market your property. You can also edit your property details or add photos at any time below.";
        } else {
            $message = "Your property has been saved, but is currently unpublished. To publish the property or to add photos,  you can edit your property below.";
        }
        return redirect()->route('listing.index')->with([
            'message' => $message
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        if ($listing->user_id != auth()->user()->id) {
            (new CreateRecentlyViewed())->execute(auth()->user(), $listing);
        }

        (new IncrementViews())->execute($listing);

        return Inertia::render('Listing/ListingShow', [
            'title' => 'Viewing ' . $listing->description,
            'listing' => ListingResource::make($listing->load('agent')),
            'similar_listings' => ListingResource::collection((new GetSimilarListings())->execute($listing))
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return Inertia::render('Listing/ListingEdit', [
            'listing' => ListingResource::make($listing->load(['features'])),
            'features' => FeatureResource::collection(
                collect(Feature::where('global', 1)->get())
                    ->merge(collect($listing->features))
                    ->unique('name')
            )
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing, UpdateListing $updateListing)
    {
        $listing = $updateListing->execute($listing, $request->all());

        return redirect()->route('listing.edit', $listing->reference);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        //
    }

    public function publish(Listing $listing, PublishOrUnPublishListing $publishListing)
    {
        $publishListing->execute($listing);

        return redirect()->back();
    }

    public function unpublish(Listing $listing, PublishOrUnPublishListing $publishListing)
    {
        $publishListing->execute($listing);

        return redirect()->back();
    }

}
