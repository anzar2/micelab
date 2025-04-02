<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Models\User;
use App\Services\WriteService;
use Illuminate\Http\Request;

class UpdateRoleController extends Controller
{
    public function update_role(Request $request, $user_id)
    {
        // This route should be protected with ProtectOwnership
        
        $target_user = User::find($user_id);
        
        $data = [
            "global_role" => $request->input("global_role"),
            "user_id" => $user_id
        ];

        $validator = \Validator::make($data, [
            'global_role' => 'required|in:admin,owner,developer',
            'user_id' => 'required|exists:users,id',
        ]);

        return $this->writeService->
            update(
                User::class,
                $target_user->id,
                $validator,
                $data,
                "Role updated for ". $target_user->display_name ." successfully"
            );
    }

}
