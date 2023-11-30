<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class helloworld extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hello:world';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Retrieve users with role 'user' and active status
        info('Retrieving users with role \'user\' and active status');
        $usersToUpdate = User::where('active', 1)->role('user')
            ->get();

        // Update balances for the selected users
        foreach ($usersToUpdate as $user) {
            // Add 4.40 to the user's balance
            $user->balance += 4.40;
            // Save the updated user
            $user->save();
        }

        return Command::SUCCESS;
    }
}
