<?php

namespace App\Actions\Agent;

use App\Models\Agent;

class CreateAgent
{
    public function execute(array $request)
    {
        $this->validate($request);

        $agent = Agent::create([
            'name' => $request['agent_name'],
            'address_line_one' => ucwords($request['address_line_one']),
            'address_line_two' => ucwords($request['address_line_two']),
            'city' => ucwords($request['city']),
            'country' => ucwords($request['country']),
            'postcode' => \Str::upper($request['postcode']),
            'province' => ucwords($request['province']),
            'siren' => $request['siren'],
            'telephone' => $request['telephone']
        ]);

        return tap($agent)->fresh();
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
