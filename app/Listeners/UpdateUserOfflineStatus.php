<?php

namespace App\Listeners;

use App\Events\UserLoggedOut;
use App\Events\UserStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class UpdateUserOfflineStatus
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserLoggedOut $event): void
    {
        $event->user->update(['is_online' => false]);

        //broadcast offline userstatuschanged event
        broadcast(new UserStatusChanged($event->user, 0));
    }
}
