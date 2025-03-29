<?php

namespace App\Http\Controllers;

use App\Http\Responses\JsonResponse;
use App\Models\ProjectModule;
use App\Services\WriteService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RuntimeException;

class ModulesController extends Controller
{
    protected $writeService;
    public function __construct(WriteService $writeService)
    {
        $this->writeService = $writeService;
    }

    public function all($project_id)
    {
        $modules = ProjectModule::where("project_id", $project_id)
            ->where("deleted", false)
            ->get();
        return response()->json($modules);
    }

    public function get($project_id, $module_id)
    {
        $modules = ProjectModule::where("project_id", $project_id)
            ->where("id", $module_id)
            ->where("deleted", false)
            ->get()->first();
        return response()->json($modules);
    }

    public function store(Request $request, $project_id)
    {
        $data = $request->only(["module_name", "color"]);

        $validator = \Validator::make($data, [
            "module_name" => [
                "required",
                Rule::unique('project_modules')->where('project_id', $project_id)
            ],
            "color" => ['regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ]);

        return $this->writeService->create(
            ProjectModule::class,
            $validator,
            array_merge($data, ["project_id" => $project_id]),
            "Module created successfully"
        );
    }

    public function update(Request $request, $project_id, $module_id)
    {
        $data = $request->only(["module_name", "color"]);
        $validator = \Validator::make($data, [
            "module_name" => [
                "required",
                Rule::unique("project_modules")
                ->where("project_id", $project_id)
                ->ignore($module_id)
            ],
            "color" => ['regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ]);
        return $this->writeService->update(
            ProjectModule::class,
            $module_id,
            $validator,
            array_merge($data, ["project_id" => $project_id]),
            "Module updated successfully"
        );
    }

    public function trash($project_id, $module_id)
    {
        return $this->writeService->trash(
            ProjectModule::class,
            $module_id,
            "Module trashed successfuly",
            [
                "affected" => $module_id
            ]
        );
    }

    public function recover($project_id, $module_id)
    {
        return $this->writeService->recover(
            ProjectModule::class,
            $module_id,
            "Module recovered successfuly",
            [
                "affected" => $module_id
            ]
        );
    }

    public function delete($project_id, $module_id)
    {
        return $this->writeService->delete(
            ProjectModule::class,
            $module_id,
            "Module deleted successfuly",
            [
                "affected" => $module_id
            ]
        );
    }
}
