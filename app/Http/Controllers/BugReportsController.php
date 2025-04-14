<?php

namespace App\Http\Controllers;

use App\Models\BugReport;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BugReportsController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->input("page", 1);
        $perPage = 20;
        $reports = BugReport::paginate(page: $page, perPage: $perPage);
        return response()->json($reports);
    }

    public function show(BugReport $bugReport)
    {
        return response()->json($bugReport);
    }

    public function store(Request $request, Project $project)
    {
        $data = [
            "title"=> $request->input("title"),
            "bug_description"=> $request->input("bug_description"),
            "steps_to_reproduce"=> $request->input("steps_to_reproduce"),
            "requirement_id" => $request->input("requirement_id"),
            "project_id" => $project->id
        ];

        $validator = \Validator::make($data, [
            "title"=> "required|unique:bug_reports,title",
            "bug_description"=> "required|string",
            "steps_to_reproduce" => "required|array",
            "requirement_id" => "required|exists:project_requirements,id"
        ]);

        return $this->writeService->create(
            BugReport::class,
            $validator,
            $data,
            "Bug Report created"
        );
    }


    public function update(Request $request, Project $project, BugReport $bugReport)
    {
        $data = [
            "title"=> $request->input("title"),
            "bug_description"=> $request->input("bug_description"),
            "steps_to_reproduce"=> $request->input("steps_to_reproduce"),
            "requirement_id" => $request->input("requirement_id"),
            "project_id" => $project->id
        ];

        $validator = \Validator::make($data, [
            "title"=> ["required", Rule::unique("bug_reports")->ignore($bugReport->id)],
            "bug_description"=> "required|string",
            "steps_to_reproduce" => "required|array",
            "requirement_id" => "required|exists:project_requirements,id"
        ]);

        return $this->writeService->update(
            BugReport::class,
            $bugReport->id,
            $validator,
            $data,
            "Bug Report updated"
        );
    }

    public function destroy(Project $project, BugReport $bugReport)
    {
        return $this->writeService->delete(
            BugReport::class,
            $bugReport->id,
            "Bug Report deleted"
        );
    }
}
