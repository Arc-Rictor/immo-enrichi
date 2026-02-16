<?php

use App\Models\Feature;
use function Pest\Laravel\assertDatabaseCount;

it('can add a new feature', function () {
   $this->actingAs($this->user)->post(route('feature.store'), [
       'name' => 'Test Feature'
   ]);

   assertDatabaseCount('features', 1);
});

it('can only add features with a unique name', function () {
    Feature::factory()->create(['name' => 'Test']);

    $response = $this->actingAs($this->user)->post(route('feature.store', [
        'name' => 'Test'
    ]))->assertSessionHasErrors('name');

    $response->assertStatus(302);

    assertDatabaseCount('features', 1);
});
