<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectRequirement;
use App\Models\TestCase;
use Illuminate\Http\Request;

class TestCaseController extends Controller
{
    public function index(Request $request, Project $project, ProjectRequirement $requirement)
    {
        $perPage = 20;
        $page = $request->get("page", 1);
        $test_cases = TestCase::with(["createdBy", "testType", "testStatus", "requirement"])
            ->where("requirement_id", $requirement->id)
            ->paginate(perPage: $perPage, page: $page);
        return response()->json($test_cases);
    }

    public function show(Project $project, ProjectRequirement $requirement, $test_case_id)
    {
        $test_case = TestCase::where("requirement_id", $requirement->id)
            ->where("id", $test_case_id)
            ->first();
        return response()->json($test_case);
    }

    public function store(Request $request, Project $project, ProjectRequirement $requirement)
    {
        $data = $request->only([
            "title",
            "description",
            "steps",
            "obtained_resut",
            "test_comments",
            "duration_in_seconds",
            "test_version",
            "pre_conditions",
            "is_automated",
            "test_type",
            "test_status"
        ]);

        $validator = \Validator::make($data, [
            "title" => "required",
            "description" => "required",
            "obtained_result" => "required",
            "test_comments"=> "required",
            "duration_in_seconds" => "required"
        ]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

    public function trash()
    {

    }

    public function recover()
    {

    }
}
