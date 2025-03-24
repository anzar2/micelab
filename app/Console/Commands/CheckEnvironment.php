<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckEnvironment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-environment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if app is on production or debug';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $env = config('app.env');
        $debug = config('app.debug');

        if ($env === 'production' && !$debug) {
            $this->info('The app is running in production mode.');
        } elseif ($env === 'local' && $debug) {
            $this->info('The app is running in debug mode.');
        } else {
            $this->info('The app is running in an unknown environment.');
        }
    }
}
