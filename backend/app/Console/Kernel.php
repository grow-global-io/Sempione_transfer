<?php

namespace App\Console;

use App\Models\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $users = User::whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })->get();
            foreach ($users as $user) {
                $user->balance += 4.40; // add 4.40 to the user's balance
                $user->save(); // save the updated user model
            }
        })->everyTwoMinutes();
        // $schedule->call(function () {
        //     info('Hello world');
        // })->everySecond();
        // $schedule->call(function () {

        //         info('Hello world');
        // })->everyMinute()->when(function () {
        //     return now()->second % 1 === 0; // Run every second
        // });
        // $schedule->command('inspire')->hourly();
        // $schedule->call(function () {

        // })->everySecond();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
