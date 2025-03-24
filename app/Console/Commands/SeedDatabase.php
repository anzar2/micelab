<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * The reason of this command is to seed the database. 
 * "Why don't you just use db:seed instead?"
 * Because db:seed doesn't return a stderr when it fails.
 * This is important for the CLI execution in order to handle the errors. 
 * That said, this command is used only by mlab command line installer.
 * 
 * If you want to seed manually, just use db:seed normally
 * -anzar2
 */
class SeedDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-database';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed the database. Is not intended to be used by the user. Use db:seed if you want to do it manually';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            \Artisan::call('db:seed', ['--force' => true]);
            fwrite(STDOUT,'Database seeded successfully');
        } catch (\Exception $e) {
            \Artisan::call("db:wipe", ["--force"=> true]);
            if (file_exists(base_path(".env"))) {
                unlink(base_path(".env"));
            }
            fwrite(STDERR, $e->getMessage() . PHP_EOL . "\nAll actions has been rolled back");
        }
    }
}
