<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecentlyViewedListing extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function listing()
    {
        return $this->hasOne(Listing::class);
    }
}
