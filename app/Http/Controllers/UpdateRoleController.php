<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UpdateRoleController extends Controller
{
    public function update_role(Request $request, User $user)
    {
        // This route should be protected with ProtectOwnership
        
        $data = [
            "global_role" => $request->input("global_role"),
            "user_id" => $user->id
        ];

        $validator = \Validator::make($data, [
            'global_role' => 'required|in:admin,owner,developer',
            'user_id' => 'required|exists:users,id',
        ]);

        return $this->writeService->
            update(
                User::class,
                $user->id,
                $validator,
                $data,
                __("messages.entity_actions.role_updated", [
                    "Entity" => $user->display_name
                ])  
            );
    }

}
