<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\UserRole;
use Hash;
use Illuminate\Console\Command;
use League\Uri\Encoder;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin {display_name} {email} {password} {username}';

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
        try {
            $display_name = $this->argument('display_name');
            $email = $this->argument('email');
            $password = $this->argument('password');
            $username = $this->argument('username');
            $user = User::create([
                'display_name' => $display_name,
                'email' => $email,
                'password' => Hash::make($password),
                'username' => $username,
                'global_role' => "owner",
            ]);

            fwrite(STDOUT,sprintf("User created successfully\nID: %s\nDisplay Name: %s\nUsername: %s\nEmail: %s\nGlobal Role: %s", $user->id, $user->display_name, $user->username, $user->email, $user->globalRole->name));
        } catch (\Exception $e) {
            \Artisan::call("db:wipe", ["--force"=> true]);
            if (file_exists(base_path(".env"))) {
                unlink(base_path(".env"));
            }
            fwrite(STDERR, $e->getMessage() . PHP_EOL . "\nAll actions has been rolled back");
        }

    }
}
