<?php

use App\Models\Feature;
use App\Models\Listing;
use App\Models\User;

it('can create a new listing', function () {

    $request = Listing::factory()->make(['user_id' => 1]);

    $response = $this->actingAs($this->user)->post(route('listing.store'), $request->toArray());

    $response->assertRedirect();

    $this->assertDatabaseCount(Listing::class, 1);
});

it('can update a listing', function () {
    $listing = Listing::factory()->create(['user_id' => 1, 'reference' => 'test', 'description' => 'Test description']);

    expect($listing->refresh()->description)->toBe('Test description');

    $this->actingAs($this->user)->patch(route('listing.update', ['listing' => $listing->refresh()->reference]), [
        'description' => 'Updated description'
    ]);

    expect(Listing::first()->description)->toBe('Updated description');
});

it('can link features to a listing', function () {
    $listing = Listing::factory()->create(['user_id' => 1, 'reference' => 'test']);

    $features = Feature::factory(3)->create();

    $this->actingAs($this->user)->patch(route('listing.update', ['listing' => $listing->refresh()->reference]), [
        'features' => $features->map(function ($feature) {
            return $feature->name;
        })->toArray()
    ]);

    $this->assertCount(3, $listing->fresh()->features);
});

it('automatically retrieves latitude and longitude when created', function () {
    $listing = Listing::factory()->create([
        'user_id' => 1,
        'address_line_one' => 'Blackpool Tower, Bank Hey Street',
        'postcode' => 'FY1 4BJ',
        'city' => 'Blackpool',
        'province' => 'Lancashire',
        'reference' => 'test'
    ]);

    $features = Feature::factory(3)->create();

    $this->actingAs($this->user)->patch(route('listing.update', $listing->reference), [
        'features' => $features->map(function ($feature) {
            return $feature->name;
        })->toArray()
    ]);

    expect($listing->fresh()->latitude)->not()->toBeNull()
        ->and($listing->fresh()->longitude)->not()->toBeNull();

});

it('can publish a listing', function () {
    $listing = Listing::factory()->create([
        'user_id' => 1,
        'address_line_one' => 'Blackpool Tower, Bank Hey Street',
        'postcode' => 'FY1 4BJ',
        'city' => 'Blackpool',
        'province' => 'Lancashire',
        'reference' => 'test'
    ]);


    expect($listing->fresh()->status)->toBe('draft')
        ->and($listing->fresh()->published_at)->toBeNull();

    $this->actingAs($this->user)->post(route('listing.publish', $listing->fresh()->reference));

    expect($listing->fresh()->status)->toBe('published')
        ->and($listing->fresh()->published_at)->not()->toBeNull();

});

it('can unpublish a listing', function () {
    $listing = Listing::factory()->create([
        'user_id' => 1,
        'address_line_one' => 'Blackpool Tower, Bank Hey Street',
        'postcode' => 'FY1 4BJ',
        'city' => 'Blackpool',
        'province' => 'Lancashire',
        'status' => 'published',
        'published_at' => \Carbon\Carbon::now(),
        'reference' => 'test'
    ]);

    expect($listing->fresh()->status)->toBe('published')
        ->and($listing->fresh()->published_at)->not()->toBeNull();

    $this->actingAs($this->user)->post(route('listing.unpublish', $listing->fresh()->reference));

    expect($listing->fresh()->status)->toBe('draft')
        ->and($listing->fresh()->published_at)->toBeNull();

});

it("won't allow a buyer to list a property", function () {
    $user = $this->user;

    $user->update(['type' => 'buyer']);

    expect($user->canListProperties())->toBeFalse();
});

it('will only allow a seller to list a property without any published listings', function () {
    $user = $this->user;

    $user->update(['type' => 'seller']);

    expect($user->canListProperties())->toBeTrue();

    Listing::factory()->create(['reference' => 'test', 'user_id' => 1, 'status' => 'published']);

    expect($user->refresh()->canListProperties())->toBeFalse();
});
