<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\UsersProjects;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectsController extends Controller
{
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
        $data = $request->only("project_name", "description");
        
        $validator = \Validator::make($data, [
            "project_name" => "required|unique:projects,name",
            "description" => "required"
        ]);

        
        return $this->writeService->create(
            Project::class,
            $validator,
            $data,
            __("messages.entity_actions.created", [
                "Entity" => __("entities.project"),
            ])
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
            __("messages.entity_actions.update", [
                "Entity" => __("entities.project"),
            ])

        );
    }

    public function trash(Project $project)
    {
        return $this->writeService->trash(
            Project::class,
            $project->id,
            __("messages.entity_actions.trashed", [
                "Entity" => __("entities.project"),
            ])
        );
    }

    public function recover(Project $project)
    {
        return $this->writeService->recover(
            Project::class,
            $project->id,
            __("messages.entity_actions.restored", [
                "Entity" => __("entities.project"),
            ])
        );
    }

    public function destroy(Project $project)
    {
        return $this->writeService->delete(
            Project::class,
            $project->id,
            __("messages.entity_actions.deleted", [
                "Entity" => __("entities.project"),
            ])
        );
    }
}
