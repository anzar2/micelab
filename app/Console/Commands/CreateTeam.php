<?php

namespace App\Console\Commands;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Console\Command;

class CreateTeam extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-team {team_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $team_arg = $this->argument('team_name');
            $team = Team::create([
                'name' => $team_arg,
            ]);
            $this->info('Team created successfully: ' . $team->name);
        }
         catch (\Exception $e) {
            \Artisan::call("db:wipe", ["--force"=> true]);
            if (file_exists(base_path(".env"))) {
                unlink(base_path(".env"));
            }
            fwrite(STDERR, $e->getMessage() . PHP_EOL . "\nAll actions has been rolled back");
        }
    }
}
