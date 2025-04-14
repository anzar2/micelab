<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Models\Project;
use App\Models\ProjectRequirement;
use App\Models\TestCase;
use App\Services\WriteService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function show(Project $project, ProjectRequirement $requirement, TestCase $test_case)
    {
        $test_case = TestCase::where("requirement_id", $requirement->id)
            ->where("id", $test_case->id)
            ->first();
        return response()->json($test_case);
    }

    public function store(Request $request, Project $project, ProjectRequirement $requirement)
    {
        $data = [
            "case_title" => $request->input("case_title"),
            "case_description" => $request->input("case_description"),
            "steps" => $request->input("steps"),
            "obtained_result" => $request->input("obtained_result"),
            "test_comments" => $request->input("test_comments"),
            "duration_in_seconds" => $request->input("duration_in_seconds"),
            "test_version" => $request->input("test_version"),
            "pre_conditions" => $request->input("pre_conditions"),
            "is_automated" => $request->input("is_automated"),
            "test_type" => $request->input("test_type"),
            "test_status" => $request->input("test_status"),
            "requirement_id" => $requirement->id,
        ];

        $validator = \Validator::make($data, [
            "case_title" => "required|string|unique:test_cases,case_title",
            "case_description" => "required",
            "steps" => "required|array",
            "obtained_result" => "nullable|string",
            "test_comments" => "nullable|string",
            "duration_in_seconds" => "nullable|numeric",
            "test_version" => "nullable|string",
            "pre_conditions" => "nullable|array",
            "is_automated" => "nullable|boolean",
            "test_type" => "nullable|numeric|exists:test_type,id",
            "test_status" => "nullable|numeric|exists:test_status,id"
        ]);

        return $this->writeService->create(
            TestCase::class,
            $validator,
            $data,
            "Test Cases Added"
        );

    }

    public function update(Request $request, Project $project, ProjectRequirement $requirement, TestCase $test_case)
    {
        $data = [
            "case_title" => $request->input("case_title"),
            "case_description" => $request->input("case_description"),
            "steps" => $request->input("steps"),
            "obtained_result" => $request->input("obtained_result"),
            "test_comments" => $request->input("test_comments"),
            "duration_in_seconds" => $request->input("duration_in_seconds"),
            "test_version" => $request->input("test_version"),
            "pre_conditions" => $request->input("pre_conditions"),
            "is_automated" => $request->input("is_automated"),
            "test_type" => $request->input("test_type"),
            "test_status" => $request->input("test_status"),
            "requirement_id" => $requirement->id,
        ];

        $validator = \Validator::make($data, [
            "case_title" => ["required", "string", Rule::unique("test_case")->ignore($test_case->id)],
            "case_description" => "required",
            "steps" => "required|array",
            "obtained_result" => "nullable|string",
            "test_comments" => "nullable|string",
            "duration_in_seconds" => "nullable|numeric",
            "test_version" => "nullable|string",
            "pre_conditions" => "nullable|array",
            "is_automated" => "nullable|boolean",
            "test_type" => "nullable|numeric|exists:test_type,id",
            "test_status" => "nullable|numeric|exists:test_status,id"
        ]);

        return $this->writeService->update(
            TestCase::class,
            $requirement->id,
            $validator,
            $data,
            "Test case updated"
        );
    }

    public function destroy(Project $project, ProjectRequirement $requirement, TestCase $test_case)
    {
        return $this->writeService->delete(
            TestCase::class,
            $requirement->id,
            "Test case deleted"
        );
    }

    public function trash(Project $project, ProjectRequirement $requirement, TestCase $test_case)
    {
        return $this->writeService->trash(
            TestCase::class,
            $test_case->id,
            "Test Case trashed"
        );
    }

    public function recover(Project $project, ProjectRequirement $requirement, TestCase $test_case)
    {
        return $this->writeService->recover(
            TestCase::class,
            $test_case->id,
            "Test Case recovered"
        );
    }

    public function publish(Project $project, ProjectRequirement $requirement, TestCase $test_case)
    {
        $test_case->published = true;
        $test_case->save();
        
        return JsonResponse::ok("Test Case is published");
    }
    public function unpublish(Project $project, ProjectRequirement $requirement, TestCase $test_case)
    {
        $test_case->published = false;
        $test_case->save();
        
        return JsonResponse::ok("Test Case is unpublished");
    }
}
