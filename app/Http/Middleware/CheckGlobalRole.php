<?php

namespace App\Http\Middleware;

use App\Http\Responses\JsonResponse;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckGlobalRole
{
    /**
     * Allow incoming request if the user has the roles specified (owner, admin or developer)
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        
        foreach ($roles as $role) {
            if ($user->global_role == $role) {
                return $next($request);
            }
        }
      
        return JsonResponse::unauthorized("You don't have permission to perform this action");
    }
}
