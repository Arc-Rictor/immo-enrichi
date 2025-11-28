<?php

namespace App\Http\Controllers;

use App\Actions\Listing\SubmitAgentInterest;
use App\Http\Requests\UpdateListingInterestRequest;
use App\Models\Listing;
use App\Models\ListingInterest;
use Illuminate\Http\Request;

class ListingInterestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SubmitAgentInterest $submitAgentInterest)
    {
        $submitAgentInterest->execute($request->all());

        return redirect()->back()->with([
            'message' => "Thank you for submitting your interest in this property. This has been fed back to the seller, and you can track progress via 'My Properties'"        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(ListingInterest $listingInterest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ListingInterest $listingInterest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateListingInterestRequest $request, ListingInterest $listingInterest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ListingInterest $listingInterest)
    {
        //
    }
}
