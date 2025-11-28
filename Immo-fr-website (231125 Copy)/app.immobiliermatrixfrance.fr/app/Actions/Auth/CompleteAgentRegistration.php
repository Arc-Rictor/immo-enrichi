<?php

namespace App\Actions\Auth;

use App\Actions\Agent\CreateAgent;
use App\Models\User;

class CompleteAgentRegistration
{
    public function execute(User $user, array $request)
    {
        $this->validate($request);

        // Create Agent
        $agent = (new CreateAgent())->execute($request);


        if ($agent) {
            $user->update([
                'agent_id' => $agent->id,
                'address_line_one' => ucwords($request['address_line_one']),
                'address_line_two' => ucwords($request['address_line_two']),
                'city' => ucwords($request['city']),
                'country' => ucwords($request['country']),
                'postcode' => \Str::upper($request['postcode']),
                'province' => ucwords($request['province']),
                'siren' => $request['siren'],
                'telephone' => $request['telephone']
            ]);
        }

        return tap($user)->refresh();
    }

    private function validate(array $request)
    {
        return \Validator::validate($request, [
            'address_line_one' => ['required'],
            'address_line_two' => [],
            'postcode' => ['required'],
            'province' => ['required'],
            'city' => ['required'],
            'siren' => ['required'],
            'telephone' => ['required'],
            'agent_name' => ['required']
        ]);
    }
}
