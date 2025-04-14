<?php

namespace App\Http\Controllers;

use App\Models\CaseComment;
use App\Models\Project;
use App\Models\ProjectRequirement;
use App\Models\TestCase;
use Illuminate\Http\Request;

class CaseCommentsController extends Controller
{
    public function index()
    {
        $comments = CaseComment::with(["user", "replies"])
            ->whereNull("parent_id")
            ->get();
        return response()->json($comments);
    }

    public function store(
        Request $request,
        Project $project,
        ProjectRequirement $requirement,
        TestCase $test_case
    ) {
        $data = [
            "case_comment" => $request->input("case_comment"),
            "user_id" => $request->user()->id,
            "test_case_id" => $test_case->id,
            "parent_id" => $request->input("parent_id")
        ];

        $validator = \Validator::make($data, [
            "case_comment" => "required|string",
            "parent_id" => "nullable|numeric|exists:test_cases_comments,id"
        ]);

        return $this->writeService->create(
            CaseComment::class,
            $validator,
            $data,
            "Comment added"
        );
    }

    public function update(
        Request $request,
        Project $project,
        ProjectRequirement $requirement,
        TestCase $test_case,
        CaseComment $comment
    ) {
        $data = $request->input("case_comment");

        $validator = \Validator::make($data, [
            "case_comment" => "required|string",
        ]);

        return $this->writeService->update(
            CaseComment::class,
            $comment->id,
            $validator,
            $data,
            "Comment updated"
        );
    }

    public function destroy(
        Request $request,
        Project $project,
        ProjectRequirement $requirement,
        TestCase $test_case,
        CaseComment $comment
    ) {

        return $this->writeService->delete(
            CaseComment::class,
            $comment->id,
            "Comment updated"
        );
    }

}
