<?php

namespace App\Observers\Api;

use App\Models\Api\User;
use Illuminate\Support\Facades\Log;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        Log::info("New User created: " . $user->email);
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        // log
        Log::info("User {$user->id} Updated profile.");
        // Send email
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
