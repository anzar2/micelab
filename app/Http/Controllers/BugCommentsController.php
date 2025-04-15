<?php

namespace App\Http\Controllers;

use App\Models\BugComments;
use App\Models\BugReport;
use App\Models\Project;
use Illuminate\Http\Request;

class BugCommentsController extends Controller
{
    public function index()
    {
        $comments = BugComments::with(["user", "replies"])
            ->whereNull("parent_id")
            ->get();
        return response()->json($comments);
    }

    public function store(
        Request $request,
        Project $project,
        BugReport $bug_report
    ) {
        $data = [
            "bug_comment" => $request->input("bug_comment"),
            "user_id" => $request->user()->id,
            "bug_report_id" => $bug_report->id,
            "parent_id" => $request->input("parent_id")
        ];

        $validator = \Validator::make($data, [
            "bug_comment" => "required|string",
            "parent_id" => "nullable|numeric|exists:test_cases_comments,id"
        ]);

        return $this->writeService->create(
            BugComments::class,
            $validator,
            $data,
            "Comment added"
        );
    }

    public function update(
        Request $request,
        Project $project,
        BugReport $bug_report,
        BugComments $comment
    ) {
        $data = $request->only("bug_comment");

        $validator = \Validator::make($data, [
            "bug_comment" => "required|string",
        ]);

        return $this->writeService->update(
            BugComments::class,
            $comment->id,
            $validator,
            $data,
            __("messages.entity_actions.updated", [
                "Entity" => __("entities.comment")
            ])
        );
    }

    public function destroy(
        Request $request,
        Project $project,
        BugReport $bug_report,
        BugComments $comment
    ) {

        return $this->writeService->delete(
            BugComments::class,
            $comment->id,
            __("messages.entity_actions.deleted", [
                "Entity" => __("entities.comment")
            ])
        );
    }
}
