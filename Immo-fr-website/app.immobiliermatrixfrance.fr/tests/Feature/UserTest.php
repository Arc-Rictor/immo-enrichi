<?php

it('redirects agents to complete profile before allowing access to app', function () {
   $user = \App\Models\User::factory()->create([
       'type' => 'agent',
       'address_line_one' => null
   ]);

   $response = $this->actingAs($user->refresh())->get('/dashboard');

   $response->assertStatus(302);

   $response->assertRedirectToRoute('register.agent');
});

it('grants access to the app once an agents profile is completed', function () {
    $user = \App\Models\User::factory()->create([
        'type' => 'agent',
        'address_line_one' => fake()->streetAddress,
        'address_line_two' => '',
        'postcode' => fake()->postcode,
        'city' => fake()->city,
        'province' => '1',
        'telephone' => fake()->phoneNumber,
        'siren' => fake()->randomNumber(5)
    ]);

    $response = $this->actingAs($user->refresh())->get('/dashboard');

    $response->assertStatus(200);
});
