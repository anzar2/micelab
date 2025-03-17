<?php

namespace App\Observers;

use App\Models\User;
use App\Models\UserPreference;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $default = UserPreference::create([
            "user_id"=> $user->id,
            "theme"=> 'auto',
            'language'=> 'en',
            'timezone'=> 417,
        ]);
        $user->user_preferences = $default->id;
        $user->save();
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
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
