<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $team = Team::first();
        return view("app", ["team" => $team]);
    }
}
