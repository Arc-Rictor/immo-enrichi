<?php

namespace App\Actions\Listing;

use App\Models\User;

class GetListingInterestForUsersProperties
{
    public function execute(User $user)
    {
        return $user->listings
            ->load('interest', 'interest.agent', 'interest.listing')
            ->pluck('interest')
            ->values()
            ->flatten()
            ->where('status', 'pending');
    }
}
