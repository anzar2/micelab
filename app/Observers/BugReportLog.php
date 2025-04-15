<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\BugReport;
use Illuminate\Support\Facades\Auth;

class BugReportLog
{
    /**
     * Handle the BugReport "created" event.
     */
    public function created(BugReport $bug_report): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "create",
                "subject_type" => "bug_report",
                "subject_id" => $bug_report->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }

    /**
     * Handle the BugReport "updated" event.
     */
    public function updated(BugReport $bug_report): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "update",
                "subject_type" => "bug_report",
                "subject_id" => $bug_report->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }

    /**
     * Handle the BugReport "deleted" event.
     */
    public function deleted(BugReport $bug_report): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "delete",
                "subject_type" => "bug_report",
                "subject_id" => $bug_report->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }
}
