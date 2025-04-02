<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Models\User;
use App\Models\UserPreference;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function get(Request $request)
    {
        $user = User::with(["preferences"])->find($request->user()->id);
        return response()->json($user);
    }

    public function update(Request $request)
    {
        $data = $request->only(["display_name", "email"]);
        $validator = \Validator::make($data, [
            "display_name" => "required|string",
            "email" => "email|nullable",
        ]);

        return $this->writeService->update(
            User::class,
            $request->user()->id,
            $validator,
            $data,
            "Your data has been updated"
        );
    }
    public function update_preferences(Request $request)
    {
        $data = [
            "user_id" => $request->user()->id,
            "language" => $request->input("language"),
            "theme" => $request->input("theme"),
            "timezone" => $request->input("timezone"),
        ];
      
        $validator = \Validator::make($data, [
            "user_id" => "required|exists:users,id",
            "language" => "required|exists:languages,code",
            "theme" => "required|exists:themes,code",
            "timezone" => "required|numeric|exists:timezones,code",
        ]);

        if ($validator->fails()) {
            return JsonResponse::badRequest("Form has been rejected", $validator->errors()->all());
        }

        $user_preferences = UserPreference::where("user_id", $request->user()->id)->first();
        $user_preferences->update($data);
        return JsonResponse::ok("Your preferences has been updated");
    }
}
