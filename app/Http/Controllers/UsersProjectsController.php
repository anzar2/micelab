<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Models\UsersProjects;
use App\Services\WriteService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersProjectsController extends Controller
{
    protected $writeSrv;
    public function __construct(WriteService $writeService)
    {
        $this->writeSrv = $writeService;
    }

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

    public function store($project_id, $user_id)
    {
        $data = [
            "user_id" => $user_id,
            "project_id" => $project_id,
        ];

        $validator = \Validator::make($data, [
            "user_id" => [
                "required",
                "exists:users,id",
                Rule::unique("users_projects")->where(function ($query) use ($project_id) {
                    return $query->where("project_id", $project_id);
                }),
            ],
            "project_id" => "required|exists:projects,id",
        ]);

        return $this->writeSrv->create(
            UsersProjects::class,
            $validator,
            $data,
            "User added to project successfully"
        );
    }

    public function show(Request $request, string $project_id, string $user_id)
    {
        // We exclude users with global role "owner"

        $user = UsersProjects::with("user")
            ->where("project_id", $project_id)
            ->where("user_id", $user_id)
            ->whereHas("user", function ($query) use ($request) {
                $query->where("global_role", "!=", "owner");
            })
            ->first();

        return response()->json($user->user ?? null);
    }

    // Delete a user from a project
    public function destroy(Request $request, $project_id, $user_id)
    {
        $data = [
            "user_id" => $user_id,
            "project_id" => $project_id
        ];

        if ($request->user()->id == $user_id) {
            return JsonResponse::badRequest("You can't remove yourself!", "If your intention is to leave the project, use the leave action");
        }

        $validator = \Validator::make($data, [
            "user_id" => [
                "required",
                "exists:users_projects,user_id",
                Rule::exists('users_projects')->where(function ($query) use ($project_id, $user_id) {
                    $query->where('project_id', $project_id)
                        ->where('user_id', $user_id);
                })
            ],
            "project_id" => "required|exists:users_projects,project_id"
        ]);

        if ($validator->fails()) {
            return JsonResponse::badRequest($validator->errors()->all());
        }

        $projects_user = UsersProjects::where("project_id", $project_id)
            ->where("user_id", $user_id)
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

    public function leave(Request $request, $project_id)
    {
        $user_id = $request->user()->id;
        $projects = UsersProjects::where("project_id", $project_id)
            ->where("user_id", $user_id)->first();

        if (!$projects) {
            return JsonResponse::notFound(
                "User not found in project",
                [
                    "target" => $request->user()
                ]
            );
        }

        return JsonResponse::ok("You left the project successfully");
    }
}
