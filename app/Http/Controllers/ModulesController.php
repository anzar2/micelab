<?php
namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectModule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ModulesController extends Controller
{
    public function index(Project $project)
    {
        $modules = ProjectModule::where("project_id", $project->id)
            ->where("deleted", false)
            ->get();
        return response()->json($modules);
    }

    public function show(Project $project, ProjectModule $module)
    {
        $modules = ProjectModule::where("project_id", $project->id)
            ->where("id", $module->id)
            ->where("deleted", false)
            ->get()->first();
        return response()->json($modules);
    }

    public function store(Request $request, Project $project)
    {
        $data = [
            "name" => $request->input("name"),
            "color" => $request->input("color"),
            "project_id" => $project->id,
        ];

        $validator = \Validator::make($data, [
            "name" => [
                "required",
                Rule::unique('project_modules')->where('project_id', $project->id)
            ],
            "color" => ['regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/']
        ]);

        return $this->writeService->create(
            ProjectModule::class,
            $validator,
            $data,
            "Module created successfully"
        );
    }

    public function update(Request $request, Project $project, ProjectModule $module)
    {
        $data = [
            "name" => $request->input("name"),
            "color" => $request->input("color"),
            "project_id" => $project->id,
        ];

        $validator = \Validator::make($data, [
            "name" => [
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
            $data,
            "Module updated successfully"
        );
    }

    public function trash(Project $project, ProjectModule $module)
    {
        return $this->writeService->trash(
            ProjectModule::class,
            $module->id,
            "Module trashed successfuly"
        );
    }

    public function recover(Project $project, ProjectModule $module)
    {
        return $this->writeService->recover(
            ProjectModule::class,
            $module->id,
            "Module recovered successfuly"
        );
    }

    public function destroy(Project $project, ProjectModule $module)
    {
        return $this->writeService->delete(
            ProjectModule::class,
            $module->id,
            "Module deleted successfuly"
        );
    }
}
