<?php

namespace App\Actions\Listing;

use App\Models\Agent;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class GetAvailableListingsForAgents
{
    public function execute(User $user)
    {
        if ($user->type !== 'agent' && $user->type !== 'admin') {
            return collect();
        }

        return Listing::whereNull('agent_id')->get();
    }
}
