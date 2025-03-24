<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;


/**
 * The reason of this command is to generate a new key. 
 * "Why don't you just use `php artisan key:generate` instead?"
 * Because `key:generate` doesn't return a stderr when it fails.
 * This is important for the CLI execution in order to handle the errors. 
 * That said, this command is used only by mlab command line installer.
 * 
 * If you want to generate a new key manually, just use `key:generate` normally
 * -anzar2
 */
class GenerateKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new app key. Is not intended to be used by the user. Use key:generate if you want to do it manually';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $env_file = file_get_contents(base_path('.env'));

        if (preg_match("/^APP_KEY=$/m", $env_file)) {
            \Artisan::call("key:generate", ["--force" => true]);
            fwrite(STDOUT, "Key generated successfully");
        } else {
            if (file_exists(base_path(".env"))) {
                unlink(base_path(".env"));
            }
            fwrite(STDERR,"Could not create key. There's no APP_KEY variable in .env file\nAll actions has been rolled back");
        }
        
    }
}
