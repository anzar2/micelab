<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\ProjectRequirement;
use App\Models\RequirementAssignees;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RequirementsController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 20;
        $page = $request->query("page");
        $requirements = ProjectRequirement::with(["module", "assignees"])
            ->where("deleted", false)
            ->paginate(page: $page, perPage: $perPage);

        return response()->json($requirements);
    }

    public function store(Request $request, Project $project)
    {
        $data = [
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "expected_flow" => $request->input("expected_flow"),
            "module_id" => $request->input("module_id"),
            "project_id" => $project->id,
        ];

        $validator = \Validator::make($data, [
            "name" => "required|unique:project_requirements,name",
            "description" => "string",
            "expected_flow" => "required|array",
            "module_id" => "nullable|string|exists:project_modules,id",
        ]);

        return $this->writeService->create(
            ProjectRequirement::class,
            $validator,
            $data,
            "Requirement created succesfully."
        );
    }

    public function assign(Request $request, Project $project, ProjectRequirement $requirement)
    {
        $data = [
            "user_id" => $request->input("user_id"),
            "requirement_id" => $requirement->id,
        ];
        $validator = \Validator::make($data, [
            "user_id" => "uuid|exists:users,id|required|unique:requirements_assignees,user_id",
        ]);

        return $this->writeService->create(
            RequirementAssignees::class,
            $validator,
            $data,
            "User"
        );
    }

    public function show(Project $project, ProjectRequirement $requirement)
    {
        $requirement = ProjectRequirement::with(["module", "assignees"])
            ->where("project_id", $project->id)
            ->where("id", $requirement->id)->first();

        return response()->json($requirement);
    }

    public function update(Request $request, Project $project, ProjectRequirement $requirement)
    {
        $data = [
            "name" => $request->input("name"),
            "description"=> $request->input("description"),
            "expected_flow"=> $request->input("expected_flow"),
            "module_id" => $request->input("module_id"),
            "project_id"=> $project->id,
        ];

        $validator = \Validator::make($data, [
            "name" => [
                "required",
                Rule::unique("project_requirements")->ignore($requirement->d)
            ],
            "description" => "nullable|string",
            "expected_flow" => "required|array",
            "module_id" => "nullable|string|exists:project_modules,id",
        ]);

        return $this->writeService->update(
            ProjectRequirement::class,
            $requirement->id,
            $validator,
            $data,
            "Requirement updated succesfully"
        );
    }

    public function trash(Project $project, ProjectRequirement $requirement)
    {
        return $this->writeService->trash(
            ProjectRequirement::class,
            $requirement->id,
            "Requirement trashed successfully"
        );
    }
    public function recover(Project $project, ProjectRequirement $requirement)
    {
        return $this->writeService->recover(
            ProjectRequirement::class,
            $requirement->id,
            "Requirement recovered successfully"
        );
    }
    public function delete(Project $project, ProjectRequirement $requirement)
    {
        return $this->writeService->delete(
            ProjectRequirement::class,
            $requirement->id,
            "Requirement deleted successfully"
        );
    }
}
