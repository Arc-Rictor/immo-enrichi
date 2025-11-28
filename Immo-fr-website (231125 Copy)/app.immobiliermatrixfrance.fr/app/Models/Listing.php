<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Listing extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public $fillable = [
        'address_line_one',
        'address_line_two',
        'postcode',
        'province',
        'city',
        'country',
        'property_type',
        'property_size',
        'land_size',
        'bedrooms',
        'bathrooms',
        'asking_price',
        'description',
        'specification',
        'user_id',
        'status',
        'reference',
        'latitude',
        'longitude',
        'agent_id'
    ];

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }

    public function favouritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favourite_listings');
    }

    public function recentlyViewedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'recently_viewed');
    }

    public function interest(): HasMany
    {
        return $this->hasMany(ListingInterest::class);
    }

    public function registerMediaCollections(): void
{
    $this->addMediaCollection('property_photos')
        ->withResponsiveImages();
}

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('preview')
            ->performOnCollections('images')
            ->nonQueued();
    }

    public function addressString(){
        return $this->address_line_one . ', ' . $this->city . ', ' . $this->postcode . ', ' . $this->province . ', ' . $this->country;
    }

    /**
     * @param Builder $query
     * @return void
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('published_at', '!=', null);
    }
}
