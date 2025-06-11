<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $team = Team::first();
        return view("login", ["team" => $team]);
    }
    /**
     * I know it could be more elegant, but it works.
     * lmao
     */
    public function login(Request $request)
    {
        $credentials = $request->only("identifier", "password");
        
        $validator = \Validator::make($credentials, [
            "identifier" => "required",
            "password" => "required"
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')->withErrors($validator)->withInput();
        }

        $isEmail = preg_match("/^[^\s@]+@[^\s@]+\.[^\s@]+$/", $credentials["identifier"]);
        $attempt = [
            $isEmail ? "email" : "username" => $credentials["identifier"],
            "password" => $credentials["password"],
        ];

        if (\Auth::attempt($attempt)) {
            return redirect("/app");
        }

        return redirect()->route("login")->with("error",__("auth.failed"));
    }
}
