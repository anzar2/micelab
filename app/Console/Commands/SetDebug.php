<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetDebug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-development';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set development mode';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (file_exists(base_path('.env'))) {
            $env_content = file_get_contents(base_path('.env'));
            $env_content = str_replace('APP_ENV=production', 'APP_ENV=local', $env_content);
            $env_content = str_replace('APP_DEBUG=false', 'APP_DEBUG=true',$env_content);
            file_put_contents(base_path('.env'), $env_content);
            
            \Artisan::call('cache:clear');
            \Artisan::call('config:cache');

            fwrite(STDOUT,'Debug mode enabled');
            return;
        }

        fwrite(STDERR,'.env file not found');
    }
}
