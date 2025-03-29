<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Services\WriteService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    protected $writeService;
    public function __construct(WriteService $writeService)
    {
        $this->writeService = $writeService;
    }

    public function all()
    {
        $users = User::paginate();
        return response()->json($users);
    }

    public function get($user_id)
    {
        $user = User::find($user_id);
        return response()->json($user);
    }

    public function search(Request $request)
    {
        // This query should be better!
        // It should implement a better search depending on database engine's capabilities !!
        // For example, if we are using MySQL, we can use full text search
        // By now, we are using LIKE operator provided by the database

        $users = User::
            orwhere(
                "display_name",
                "like",
                "%" . $request->input("query") . "%"
            )
            ->orWhere(
                "email",
                "like",
                "%" . $request->input("query") . "%"
            )
            ->orWhere(
                "username",
                "like",
                "%" . $request->input("query") . "%"
            )
            ->get();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $data = $request->only([
            "display_name",
            "email",
            "username",
            "password",
            "password_confirmation"
        ]);

        $validator = \Validator::make($data, [
            "display_name" => "required",
            "username" => "required|unique:users,username|alpha_dash",
            "email" => "email|unique:users,email",
            "password" => "required|confirmed|min:8"
        ]);

        return $this->writeService->create(
            User::class,
            $validator,
            $data,
            "User created successfully",
            [
                "new" => [
                    "display_name" => $data["display_name"],
                    "email" => $data["email"],
                    "username" => $data["username"]
                ]
            ]
        );
    }

    public function update(Request $request, $user_id)
    {
        $old = User::find($user_id);

        $data = $request->only([
            "display_name",
            "email"
        ]);

        $validator = \Validator::make($data, [
            "display_name" => "required",
            "email" => [
                "required",
                Rule::unique("users")->ignore($user_id)
            ]
        ]);

        return $this->writeService->update(
            User::class,
            $user_id,
            $validator,
            $data,
            "User updated successfully",
            [
                "user_id" => $user_id,
                "old" => [
                    "display_name" => $old->display_name,
                    "display_email" => $old->email
                ],
                "new" => $data
            ]
        );
    }

    public function trash(Request $request, $user_id)
    {
        // This route must be protected with ProtectOwnership

        return $this->writeService->trash(
            User::class,
            $user_id,
            "User trashed successfully"
        );
    }

    public function recover($user_id)
    {
        return $this->writeService->recover(
            User::class,
            $user_id,
            "User recovered successfully"
        );
    }

    public function delete($user_id)
    {
        // This route must be protected with ProtectOwnership

        return $this->writeService->delete(
            User::class,
            $user_id,
            "User deleted permanently",
            ["user_id" => $user_id]
        );
    }
}
