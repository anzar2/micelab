<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserRole;
use Hash;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin {first_name} {last_name} {email} {password} {username}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It creates the admin user based on the parameters passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $first_name = $this->argument('first_name');
        $last_name = $this->argument('last_name');
        $email = $this->argument('email');
        $password = $this->argument('password');
        $username = $this->argument('username');
        $user = User::create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => Hash::make($password),
            'username' => $username
        ]);
        $user->role_id = UserRole::find(1);
        $user->save();
        $this->info('Admin user created successfully: ' . $user->email);
        
    }
}
