<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Models\ProjectRequirement;
use Illuminate\Http\Request;

class RequirementsController extends Controller
{
    public function index()
    {
        $requirements = ProjectRequirement::with(["module", "assignees"])
            ->get()
            ->makeHidden(["module_id"]);

        return response()->json($requirements);
    }

    public function store(Request $request)
    {

    }

    public function show($project_id, $requirement_id)
    {
        $requirement = ProjectRequirement::with(["module", "assignees"])
            ->where("project_id", $project_id)
            ->where("id", $requirement_id)->first();

        return response()->json($requirement);
    }

    public function update(Request $request, $id)
    {

    }
}
