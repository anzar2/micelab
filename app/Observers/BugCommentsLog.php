<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\BugComments;
use Auth;

class BugCommentsLog
{
    /**
     * Handle the BugComments "created" event.
     */
    public function created(BugComments $bug_comments): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "create",
                "subject_type" => "bug_comment",
                "subject_id" => $bug_comments->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }

    /**
     * Handle the BugComments "updated" event.
     */
    public function updated(BugComments $bug_comments): void
    {
        ActivityLog::create([
            "action" => "update",
            "subject_type" => "bug_comment",
            "subject_id" => $bug_comments->id,
            "by" => Auth::id(),
            "when" => now()
        ]);
    }

    /**
     * Handle the BugComments "deleted" event.
     */
    public function deleted(BugComments $bug_comments): void
    {
        ActivityLog::create([
            "action" => "delete",
            "subject_type" => "bug_comment",
            "subject_id" => $bug_comments->id,
            "by" => Auth::id(),
            "when" => now()
        ]);
    }
}
