<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Models\Project;
use App\Models\User;
use App\Models\UsersProjects;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersProjectsController extends Controller
{
    public function index(Request $request)
    {
        // We exclude users with global role "owner"

        $users = UsersProjects::with(["user"])

            ->whereHas("user", function ($query) {
                $query->where("global_role", "!=", "owner");
            })
            ->get()->pluck("user");

        return response()->json($users);
    }

    public function store(Request $request, Project $project)
    {
        $data = [
            "user_id" => $request->input("user_id"),
            "project_id" => $project->id,
        ];

        $validator = \Validator::make($data, [
            "user_id" => [
                "required",
                "exists:users,id",
                Rule::unique("users_projects")->where(function ($query) use ($project) {
                    return $query->where("project_id", $project->id);
                }),
            ],
        ]);

        return $this->writeService->create(
            UsersProjects::class,
            $validator,
            $data,
            "User added to project successfully"
        );
    }

    public function show(Request $request, Project $project, User $user)
    {
        // We exclude users with global role "owner"

        $user = UsersProjects::with("user")
            ->where("project_id", $project->id)
            ->where("user_id", $user->id)
            ->whereHas("user", function ($query) {
                $query->where("global_role", "!=", "owner");
            })
            ->first();

        return response()->json($user->user ?? null);
    }

    // Delete a user from a project
    public function destroy(Request $request, Project $project, User $user)
    {
        $projects_user = UsersProjects::where("project_id", $project->id)
            ->where("user_id", $user->id)
            ->first();

        $projects_user->delete();

        return JsonResponse::ok("User removed from project successfully");
    }

    public function clean(Request $request, $project_id)
    {
        $user_id = $request->user()->id;
        UsersProjects::where("project_id", $project_id)
            ->where("user_id", "!=", $user_id)
            ->delete();
        return JsonResponse::ok("All users removed from project successfully");
    }
}
