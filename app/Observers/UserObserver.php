<?php

namespace App\Observers;

use App\Jobs\SendEmailUserOnUserDeletedJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class UserObserver
{


    /**
     * Handle the User "deleted" event.
     *
     * @param  User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        SendEmailUserOnUserDeletedJob::dispatch($user)->delay(Carbon::now()->addDay());
    }

    /**
     * Handle the User "restored" event.
     *
     * @param  User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @param  User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        Storage::disk('public')->delete($user->avatar);
    }
}
