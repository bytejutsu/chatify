<?php

namespace App\Jobs;

use App\Models\User;
use App\Events\UserStatusChanged;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class Heartbeat implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Fetch users who have been inactive for more than 5 minutes
        $usersToBeUpdated = User::where('last_activity', '<', now()->subMinutes(5))->get();

        // Loop through each user, update their status, and broadcast the event
        foreach ($usersToBeUpdated as $user) {
            $user->update(['is_online' => false]);

            // Broadcast the event for the specific user
            broadcast(new UserStatusChanged($user, 0));
        }
    }
}
