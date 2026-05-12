<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return array_merge(parent::toArray($request), [
            'features' => FeatureResource::collection($this->features),
            'media' => $this->getMedia('images'),
            'featured_image' => $this->getFirstMediaUrl('images'),
            'asking_price' => number_format($this->asking_price),
            'price' => $this->asking_price,
            'title' => $this->bedrooms . ' Bedroom ' . $this->property_type . ', ' . $this->city . ', ' . $this->province . ', ' .  $this->country,
            'is_new' => $this->checkIfNew(),
            'is_featured' => $this->featured,
            'views' => $this->views,
            'image_count' => $this->getMedia('images')->count(),
            'user' => $this->user->load('agent'),
            'interest' => $this->whenLoaded('interest'),
            'user_favourited' => auth()->user()->favouriteListings()->where('listing_id', $this->id)->exists()
        ]);
    }

    protected function checkIfNew()
    {
        $dateToCheck = Carbon::parse($this->published_at);

        $currentDate = Carbon::now();

       return $currentDate->diffInDays($dateToCheck) <= 7;
    }
}
