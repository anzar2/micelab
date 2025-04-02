<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class MeController extends Controller
{
    public function get(Request $request)
    {
        $user = User::with(["preferences"])->find($request->user()->id);
        return response()->json($user);
    }
}
