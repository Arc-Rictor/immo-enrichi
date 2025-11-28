<?php

namespace App\Actions\Listing;

use App\Models\Listing;

class IncrementViews
{
    public function execute(Listing $listing)
    {
        $listing->views++;

        return tap($listing)->save();
    }
}
