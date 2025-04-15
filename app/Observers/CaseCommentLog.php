<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\CaseComment;
use Illuminate\Support\Facades\Auth;

class CaseCommentLog
{
    /**
     * Handle the CaseComment "created" event.
     */
    public function created(CaseComment $case_comment): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "create",
                "subject_type" => "case_comment",
                "subject_id" => $case_comment->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }

    /**
     * Handle the CaseComment "updated" event.
     */
    public function updated(CaseComment $case_comment): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "update",
                "subject_type" => "case_comment",
                "subject_id" => $case_comment->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }

    /**
     * Handle the CaseComment "deleted" event.
     */
    public function deleted(CaseComment $case_comment): void
    {
        if (Auth::check()) {
            ActivityLog::create([
                "action" => "delete",
                "subject_type" => "case_comment",
                "subject_id" => $case_comment->id,
                "by" => Auth::id(),
                "when" => now()
            ]);
        }
    }
}
