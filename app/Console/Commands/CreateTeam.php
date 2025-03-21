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
        $team_arg = $this->argument('team_name');
        $team =Team::create([
            'name' => $team_arg,
        ]);
        $this->info('Team created successfully: ' . $team->name);
    }
}
