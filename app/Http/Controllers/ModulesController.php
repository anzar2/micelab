<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectModule;
use App\Services\WriteService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModulesController extends Controller
{
    protected $writeService;
    public function __construct(WriteService $writeService)
    {
        $this->writeService = $writeService;
    }

    public function index(Project $project)
    {
        $modules = ProjectModule::where("project_id", $project->id)
            ->where("deleted", false)
            ->get();
        return response()->json($modules);
    }

    public function show(Project $project,  ProjectModule $module)
    {
        $modules = ProjectModule::where("project_id", $project->id)
            ->where("id", $module->id)
            ->where("deleted", false)
            ->get()->first();
        return response()->json($modules);
    }

    public function store(Request $request, Project $project)
    {
        $data = $request->only(["module_name", "color"]);

        $validator = \Validator::make($data, [
            "module_name" => [
                "required",
                Rule::unique('project_modules')->where('project_id', $project->id)
            ],
            "color" => ['regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ]);

        return $this->writeService->create(
            ProjectModule::class,
            $validator,
            array_merge($data, ["project_id" => $project->id]),
            "Module created successfully"
        );
    }

    public function update(Request $request, Project $project,  ProjectModule $module)
    {
        $data = $request->only(["module_name", "color"]);
        $validator = \Validator::make($data, [
            "module_name" => [
                "required",
                Rule::unique("project_modules")
                ->where("project_id", $project->id)
                ->ignore($module->id)
            ],
            "color" => ['regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ]);
        return $this->writeService->update(
            ProjectModule::class,
            $module->id,
            $validator,
            array_merge($data, ["project_id" => $project->id]),
            "Module updated successfully"
        );
    }

    public function trash(Project $project,  ProjectModule $module)
    {
        return $this->writeService->trash(
            ProjectModule::class,
            $module->id,
            "Module trashed successfuly"
        );
    }

    public function recover(Project $project,  ProjectModule $module)
    {
        return $this->writeService->recover(
            ProjectModule::class,
            $module->id,
            "Module recovered successfuly"
        );
    }

    public function destroy(Project $project,  ProjectModule $module)
    {
        return $this->writeService->delete(
            ProjectModule::class,
            $module->id,
            "Module deleted successfuly"
        );
    }
}
