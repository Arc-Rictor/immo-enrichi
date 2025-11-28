<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Laravel\Cashier\Subscription;

class DeleteTestUsers extends Command
{
    protected $signature = 'users:delete-test {email?}';
    protected $description = 'Delete test users and their associated data';

    public function handle()
    {
        $email = $this->argument('email');
        
        if ($email) {
            $users = User::where('email', $email)->get();
        } else {
            // Get users that match test email pattern
            $users = User::where('email', 'like', 'test%@%')->get();
        }

        foreach ($users as $user) {
            // Get user details before deletion
            $this->info("Preparing to delete user: {$user->email}");
            
            try {
                // Cancel Stripe subscription if exists
                if ($user->stripe_id) {
                    $subscriptions = Subscription::where('user_id', $user->id)->get();
                    foreach ($subscriptions as $subscription) {
                        $this->info("Cancelling subscription for user: {$user->email}");
                        $subscription->cancelNow();
                    }
                }

                // Delete the user (Laravel will handle related records through model relationships)
                $user->delete();
                $this->info("Successfully deleted user: {$user->email}");
            } catch (\Exception $e) {
                $this->error("Error deleting user {$user->email}: {$e->getMessage()}");
            }
        }

        $this->info('User deletion process completed.');
    }
}