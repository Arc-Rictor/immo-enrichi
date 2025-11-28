<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    protected $attributes = [
        'global' => false
    ];

    /**
     * @return BelongsToMany
     */
    public function listings(): BelongsToMany
    {
        return $this->belongsToMany(Listing::class);
    }



}
