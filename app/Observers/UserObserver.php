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
        UserPreference::create([
            "user_id"=> $user->id,
            "theme"=> 'auto',
            'language'=> config('app.locale'),
            'timezone'=> 418,
        ]);
    }
}
