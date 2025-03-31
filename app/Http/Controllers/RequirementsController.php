<?php

namespace App\Http\Controllers;
use App\Models\Project;
use App\Models\ProjectRequirement;
use App\Models\RequirementAssignees;
use App\Services\WriteService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RequirementsController extends Controller
{

    protected $writesrv;
    public function __construct(WriteService $writeService)
    {
        $this->writesrv = $writeService;
    }
    public function index(Request $request)
    {
        $perPage = 20;
        $page = $request->query("page");
        $requirements = ProjectRequirement::with(["module", "assignees"])
            ->where("deleted", false)
            ->paginate(page: $page, perPage: $perPage);

        return response()->json($requirements);
    }

    public function store(Request $request, $project_id)
    {
        $data = $request->only([
            "name",
            "description",
            "expected_flow",
            "module_id",
        ]);

        $validator = \Validator::make($data, [
            "name" => "required|unique:project_requirements,name",
            "description" => "string",
            "expected_flow" => "required|array",
            "module_id" => "nullable|string|exists:project_modules,id",
        ]);

        return $this->writesrv->create(
            ProjectRequirement::class,
            $validator,
            array_merge($data, ["project_id" => $project_id]),
            "Requirement created succesfully."
        );
    }

    public function assign(Request $request, $project_id, $requirement_id)
    {
        $data = $request->only(["user_id"]);
        $validator = \Validator::make($data, [
            "user_id" => "uuid|exists:users,id|required|unique:requirements_assignees,user_id",
        ]);

        return $this->writesrv->create(
            RequirementAssignees::class,
            $validator,
            array_merge($data, ["requirement_id" => $requirement_id]),
            "User"
        );
    }

    public function show($project_id, $requirement_id)
    {
        $requirement = ProjectRequirement::with(["module", "assignees"])
            ->where("project_id", $project_id)
            ->where("id", $requirement_id)->first();

        return response()->json($requirement);
    }

    public function update(Request $request, $project_id, $requirement_id)
    {
        $data = $request->only([
            "name",
            "description",
            "expected_flow",
            "module_id"
        ]);

        $validator = \Validator::make($data, [
            "name" => [
                "required",
                Rule::unique("project_requirements")->ignore($requirement_id)
            ],
            "description" => "nullable|string",
            "expected_flow" => "required|array",
            "module_id" => "nullable|string|exists:project_modules,id",
        ]);

        return $this->writesrv->update(
            ProjectRequirement::class,
            $requirement_id,
            $validator,
            array_merge($data, ["project_id" => $project_id]),
            "Requirement updated succesfully"
        );
    }

    public function trash($project_id, $requeriment_id)
    {
        return $this->writesrv->trash(
            ProjectRequirement::class,
            $requeriment_id,
            "Requirement trashed successfully"
        );
    }
    public function recover($project_id, $requeriment_id)
    {
        return $this->writesrv->recover(
            ProjectRequirement::class,
            $requeriment_id,
            "Requirement recovered successfully"
        );
    }
    public function delete($project_id, $requirement_id)
    {
        return $this->writesrv->delete(
            ProjectRequirement::class,
            $requirement_id,
            "Requirement deleted successfully"
        );
    }
}
