<?php

namespace App\Http\Middleware;

use App\Http\Responses\JsonResponse;
use App\Models\Project;
use App\Models\UsersProjects;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserIsMember
{
    /**
     * Check if the user is a member of the project.
     * 
     * Allow access only to project members. (owners bypass this rule)
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        $project_id = $request->route("project_id");
       
        if(!Project::find($project_id))  {
            return JsonResponse::notFound("The project has been deleted, or doesn't exist.");
        }

        if (!($user->global_role == "owner")) {
            $user_in_project = UsersProjects::where("user_id", $user->id)
                ->where("project_id", $project_id)
                ->first();

            if (!$user_in_project) {
                return JsonResponse::forbidden("You're not a member of this project. Contact to owner or admin.");
            }
        }
        return $next($request);
    }
}
