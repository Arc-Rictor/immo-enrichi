<?php

namespace App\Actions\Listing;

use App\Models\Listing;
use Carbon\Carbon;

class PublishOrUnPublishListing
{
    public function execute(Listing $listing)
    {
        $listing->published_at === null ? $this->publish($listing) : $this->unPublish($listing);

        return tap($listing)->refresh();
    }

    protected function publish($listing): void
    {
        $listing->published_at = Carbon::now();
        $listing->status = 'published';
        $listing->save();
    }

    protected function unPublish($listing): void
    {
        $listing->published_at = null;
        $listing->status = 'draft';
        $listing->save();
    }
}
