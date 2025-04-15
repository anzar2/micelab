<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\ProjectRequirement;
use Illuminate\Support\Facades\Auth;

class RequirementLog
{
    /**
     * Handle the ProjectRequirement "created" event.
     */
    public function created(ProjectRequirement $project_requirement): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "create",
                "subject_type" => "project_requirement",
                "subject_id" => $project_requirement->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }

    /**
     * Handle the ProjectRequirement "updated" event.
     */
    public function updated(ProjectRequirement $project_requirement): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "update",
                "subject_type" => "project_requirement",
                "subject_id" => $project_requirement->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }

    /**
     * Handle the ProjectRequirement "deleted" event.
     */
    public function deleted(ProjectRequirement $project_requirement): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "delete",
                "subject_type" => "project_requirement",
                "subject_id" => $project_requirement->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }
}
