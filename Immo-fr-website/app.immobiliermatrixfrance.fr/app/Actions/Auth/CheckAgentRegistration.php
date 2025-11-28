<?php

namespace App\Actions\Auth;

use App\Models\User;

class CheckAgentRegistration
{
    public function execute(User $user)
    {
        foreach ($user->getAttributes() as $attribute => $value){
            if (in_array($attribute, $this->requiredFields()) && is_null($value)) {
                return false;
            }
        }

        return true;
    }

    private function requiredFields()
    {
        return [
            'siren',
            'address_line_one',
            'city',
            'postcode',
            'telephone'
        ];
    }
}
