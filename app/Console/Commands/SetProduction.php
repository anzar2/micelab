<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use function PHPUnit\Framework\fileExists;

class SetProduction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-production';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set production mode';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (file_exists(base_path('.env'))) {
            $env_content = file_get_contents(base_path('.env'));
            $env_content = str_replace('APP_ENV=local', 'APP_ENV=production', $env_content);
            $env_content = str_replace('APP_DEBUG=true', 'APP_DEBUG=false',$env_content);
            file_put_contents(base_path('.env'), $env_content);

            \Artisan::call('cache:clear');
            \Artisan::call('config:cache');

            fwrite(STDOUT,'Production mode enabled');
            return;
        }

        fwrite(STDERR,'.env file not found');
    }
}
