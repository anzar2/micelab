<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UsersProjects;
use App\Services\WriteService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectsController extends Controller
{

    protected $writeService;
    public function __construct(WriteService $writeService)
    {
        $this->writeService = $writeService;
    }

    public function index(Request $request)
    {
        // If the user has the global role "owner" or "admin", show all projects.
        // Otherwise, show only the projects that the user has been assigned to

        $user = $request->user();
        $user_role = $user->global_role;
        $page = $request->query("page", 1);

        if (in_array($user_role, ["owner", "admin"])) {
            $projects = Project::where('deleted', false)
                ->paginate(perPage: 20, page: $page);
        } else {
            $projects = UsersProjects::with(['project'])
                ->where("user_id", $user->id)
                ->whereHas("project", function ($q) {
                    $q->where("deleted", false);
                })
                ->get()
                ->pluck("project");
        }


        return response()->json($projects);
    }

    public function show(Project $project)
    {
        // This is protected by the middleware. Only assigned users can see the project.
        // Owners and admin bypass the validation.
        return response()->json($project);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->only(["project_name", "description"]), [
            "project_name" => "required|unique:projects,project_name",
            "description" => "required"
        ]);

        $data = $request->only("project_name", "description");

        return $this->writeService->create(
            Project::class,
            $validator,
            $data,
            "Project created successfully"
        );
    }
    
    public function update(Request $request, Project $project)
    {
        $data = $request->only("project_name", "description");
        $validator = \Validator::make($data, [
            "project_name" => ["required", Rule::unique("projects")->ignore($project->id)],
            "description" => "max:255|required"
        ]);

        return $this->writeService->update(
            Project::class,
            $project->id,
            $validator,
            $data,
            "Project updated successfully"
        );
    }

    public function trash(Project $project)
    {
        return $this->writeService->trash(
            Project::class,
            $project->id,
            "Project trashed successfully"
        );
    }

    public function recover(Project $project)
    {
        return $this->writeService->recover(
            Project::class,
            $project->id,
            "Project recovered successfully"
        );
    }

    public function destroy(Project $project)
    {
        return $this->writeService->delete(
            Project::class,
            $project->id,
            "Project deleted permanently"
        );
    }
}
