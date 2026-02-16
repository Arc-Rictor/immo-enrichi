<?php

namespace App\Actions\Listing;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetListingsForUser
{

    public \Illuminate\Support\Collection|Collection $listings;
    public function execute(User $user)
    {
        $this->listings = Listing::where('status', 'published')->get();

        if($user->type === 'seller') {
            $this->listings = $user->listings;
        }

        if ($user->type === 'agent') {
            $this->listings = Listing::where('agent_id', $user->agent->id)->get();
        }

        if ($user->type === 'admin') {
            $this->listings = Listing::all();
        }
        return $this->listings;
    }
}
