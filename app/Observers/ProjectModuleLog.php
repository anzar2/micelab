<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\ProjectModule;
use Illuminate\Support\Facades\Auth;

class ProjectModuleLog
{
    /**
     * Handle the ProjectModule "created" event.
     */
    public function created(ProjectModule $project_module): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "create",
                "subject_type" => "bug_report",
                "subject_id" => $project_module->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }

    /**
     * Handle the ProjectModule "updated" event.
     */
    public function updated(ProjectModule $project_module): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "update",
                "subject_type" => "bug_report",
                "subject_id" => $project_module->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }

    /**
     * Handle the ProjectModule "deleted" event.
     */
    public function deleted(ProjectModule $project_module): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "delete",
                "subject_type" => "bug_report",
                "subject_id" => $project_module->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }
}
