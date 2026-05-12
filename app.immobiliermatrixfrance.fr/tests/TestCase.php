<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    public User $user;

    /**
     * @throws IncompletePayment
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }
}
