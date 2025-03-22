<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * The reason of this command is to seed the database. 
 * "Why don't you just use migrate instead?"
 * Because migrate doesn't return a stderr when it fails.
 * This is important for the CLI execution in order to handle the errors. 
 * That said, this command is used only by mlab command line installer.
 * 
 * If you want to seed manually, just use migrate normally
 * -anzar2
 */
class MigrateDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:migrate-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate the database. Is not intended to be used by the user. Use "migrate" if you want to do it manually';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            \Artisan::call('migrate', ["--force" => true]);
            fwrite(STDOUT,'Database migrated successfully');
        } catch (\Exception $e) {
    
            fwrite(STDERR, $e->getMessage() . PHP_EOL . "\nThis kind of error may indicate a bad installation. Run mlab 'reinstall' to make a fresh installation.");
        }
    }
}
