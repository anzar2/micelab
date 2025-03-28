<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WriteService;
use Illuminate\Http\Request;

class MeController extends Controller
{
    protected $writeService;
    public function __construct(WriteService $writeService)
    {
        $this->writeService = $writeService;
    }
    public function get(Request $request)
    {
        $user = User::with(["preferences"])->find($request->user()->id);
        return response()->json($user);
    }
}
