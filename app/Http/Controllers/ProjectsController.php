<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Models\Project;
use App\Models\UsersProjects;
use App\Services\WriteService;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{

    protected $writeService;
    public function __construct(WriteService $writeService)
    {
        $this->writeService = $writeService;
    }

    public function all(Request $request)
    {
        // If the user has the global role "owner" or "admin", show all projects.
        // Otherwise, show only the projects that the user has been assigned to

        $user = $request->user();
        $user_role = $user->global_role;


        if (in_array($user_role, ["owner", "admin"])) {
            $projects = Project::where('deleted', false)
                ->get();
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

    public function get($project_id)
    {
        // This is protected by the middleware. Only assigned users can see the project.
        // Owners and admin bypass the validation.

        $project = Project::find($project_id);
        return response()->json($project);
    }

    /**
     *  BODY:
     *      {
     *          "name": "project_name",
     *          "description": "project description"
     *      }
     */
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

    /**
     *  BODY:
     *      {
     *          "name": "project_name",
     *          "description": "project description"
     *      }
     */
    public function update(Request $request, $project_id)
    {
        $validator = \Validator::make($request->only(["project_name", "description"]), [
            "project_name" => "unique:projects,project_name," . $project_id,
            "description" => "max:255"
        ]);

        $data = $request->only("project_name", "description");

        return $this->writeService->update(
            Project::class,
            $project_id,
            $validator,
            $data,
            "Project updated successfully"
        );
    }

    public function trash($project_id)
    {
        return $this->writeService->trash(
            Project::class,
            $project_id,
            "Project trashed successfully"
        );
    }

    public function recover($project_id)
    {
        return $this->writeService->recover(
            Project::class,
            $project_id,
            "Project recovered successfully"
        );
    }

    public function delete($project_id)
    {
        return $this->writeService->delete(
            Project::class,
            $project_id,
            "Project deleted permanently"
        );
    }
}
