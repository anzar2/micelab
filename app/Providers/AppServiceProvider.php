<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::enforceMorphMap([
            'project_requirement' => 'App\Models\ProjectRequirement',
            'test_case' => 'App\Models\TestCase',
            'case_comment' => 'App\Models\CaseComment',
            'bug_report' => 'App\Models\BugReport',
            'bug_comment' => 'App\Models\BugComments',
            'project_module' => 'App\Models\ProjectModule'
        ]);
    }
}
