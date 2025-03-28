<?php

namespace App\Http\Middleware;

use App\Http\Responses\JsonResponse;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProtectOwnership
{
    /**
     * This middleware ensures that there is always at least one owner in the system.
     * If the user is the last owner and attempts to delete their account or modify
     * their role, a bad request response is returned.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   
    public function handle(Request $request, Closure $next): Response
    {
        $target_user = $request->route("user_id");
        $owners = User::where('global_role', 'owner')->count();
        $target_is_self = $target_user == $request->user()->id;
        $request_is_owner = $request->user()->global_role == 'owner';

        if ($owners == 1 && $target_is_self && $request_is_owner) {
            return JsonResponse::badRequest(
                "You must transfer your ownership before deleting your account or modifiying your role",
                "It must be at least one owner throughout the system",
            );
        }
        return $next($request);
    }
}
