<?php

namespace App\Console;

use App\Events\UserStatusChanged;
use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Auth;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call(function () {
            // Fetch users who have been inactive for more than 5 minutes
            $usersToBeUpdated = User::where('last_activity', '<', now()->subMinutes(5))->get();

            // Loop through each user, update their status, and broadcast the event
            foreach ($usersToBeUpdated as $user) {
                $user->update(['is_online' => false]);

                // Broadcast the event for the specific user
                broadcast(new UserStatusChanged($user, 0));
            }
        })->everyTenMinutes();


    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
