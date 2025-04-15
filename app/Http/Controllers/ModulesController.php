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
            "module_name" => $request->input("module_name"),
            "color" => $request->input("color"),
            "project_id" => $project->id,
        ];

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
            $data,
            __("messages.entity_actions.created", [
                "Entity" => __("entities.module"),
            ])
        );
    }

    public function update(Request $request, Project $project, ProjectModule $module)
    {
        $data = [
            "module_name" => $request->input("module_name"),
            "color" => $request->input("color"),
            "project_id" => $project->id,
        ];

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
            $data,
            __("messages.entity_actions.update", [
                "Entity" => __("entities.module"),
            ])
        );
    }

    public function trash(Project $project, ProjectModule $module)
    {
        return $this->writeService->trash(
            ProjectModule::class,
            $module->id,
            __("messages.entity_actions.trashed", [
                "Entity" => __("entities.module"),
            ])
        );
    }

    public function recover(Project $project, ProjectModule $module)
    {
        return $this->writeService->recover(
            ProjectModule::class,
            $module->id,
            __("messages.entity_actions.restored", [
                "Entity" => __("entities.module"),
            ])
        );
    }

    public function destroy(Project $project, ProjectModule $module)
    {
        return $this->writeService->delete(
            ProjectModule::class,
            $module->id,
            __("messages.entity_actions.deleted", [
                "Entity" => __("entities.module"),
            ])
        );
    }
}
