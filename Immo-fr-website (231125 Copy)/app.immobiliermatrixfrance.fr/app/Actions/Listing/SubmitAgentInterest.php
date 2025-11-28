<?php

namespace App\Actions\Listing;

use App\Models\Agent;
use App\Models\Listing;
use App\Models\ListingInterest;
use App\Notifications\AgentSubmittedInterestNotification;

class SubmitAgentInterest
{
    public function execute(array $request)
    {
        $listingInterest = ListingInterest::create([
            'agent_id' => $request['agent_id'],
            'listing_id' => $request['listing_id'],
            'message' => $request['message']
        ]);

        $seller = Listing::find($request['listing_id'])->user;

        $seller->notify(new AgentSubmittedInterestNotification(Agent::find($request['agent_id'])));

        return $listingInterest;

    }

}
