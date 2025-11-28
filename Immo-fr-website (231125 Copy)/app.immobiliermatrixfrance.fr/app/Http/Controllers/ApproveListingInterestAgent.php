<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\ListingInterest;
use App\Models\User;
use App\Notifications\SellerAcceptedAgentNotification;
use Illuminate\Http\Request;

class ApproveListingInterestAgent extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ListingInterest $interest)
    {
        // Set the ListingInterest to approved status.
        $interest->update([
            'status' => 'approved'
        ]);

        // Update the Listing with the agent_id.
        $interest->listing->update([
            'agent_id' => $interest->agent_id
        ]);

        // Notify agent
        $agent = User::where('agent_id', $interest->agent_id)->first();
        $agent->notify(new SellerAcceptedAgentNotification(User::find($interest->listing->user_id)));

        // Find all other ListingInterest models for the Listing and set the status to 'declined'.
        foreach ($interest->listing->interest as $item) {
            if ($item->id !== $interest->id) {
                $item->update([
                    'status' => 'declined'
                ]);
            }
        }
    }
}
