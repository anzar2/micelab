<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckInstallation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-installation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if the app is installed';

    /**
     * Execute the console command.
     * 
     * This should be more robust in the future
     * - anzar2
     */
    public function handle()
    {
        try {
            if (\DB::table('migrations')->first() != null) {
                fwrite(STDERR,'[Error] An installation has been detected. Process has been aborted.');
            }
        } catch (\Exception $e) {
            fwrite(STDOUT,"Installation not found.\nStarting installation...");
        }
    }
}
