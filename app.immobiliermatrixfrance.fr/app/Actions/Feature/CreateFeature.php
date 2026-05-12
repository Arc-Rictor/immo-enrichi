<?php

namespace App\Actions\Feature;

use App\Models\Feature;

class CreateFeature
{
    public function execute(array $request)
    {
        $this->validate($request);

        $feature = Feature::create([
            'name' => ucwords($request['name'])
        ]);

        return tap($feature)->refresh();
    }

    private function validate(array $request)
    {
        return \Validator::validate($request, [
            'name' => ['required', 'unique:features']
        ]);
    }
}
