<?php

namespace Database\Seeders;

use App\Models\CaseComment;
use App\Models\TaskAssignees;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectModule;
use App\Models\ProjectTask;
use App\Models\TestType;
use App\Models\TestStatus;
use App\Models\TestCase;
use App\Models\BugReport;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear un rol de usuario
        \DB::table('user_roles')->insert([
            [
                'role' => 'admin',
                'can_create_project' => true,
                'can_delete_project' => true,
                'can_manage_users' => true,
            ],
            [
                'role'=> 'developer',
                'can_create_project'=> true,
                'can_delete_project'=> true,
                'can_manage_users'=> false,
            ]
        ]);

        \DB::table('test_type')->insert([
            [
                'name' => 'unit-test',
                'is_custom' => false,
            ],
            [
                'name' => 'integration-test',
                'is_custom' => false,
            ],
            [
                'name' => 'functional-test',
                'is_custom' => false,
            ],
            [
                'name' => 'acceptance-test',
                'is_custom' => false,
            ],
            [
                'name' => 'end-to-end-test',
                'is_custom' => false,
            ],
            [
                'name' => 'smoke-test',
                'is_custom' => false,
            ],
            [
                'name' => 'regression-test',
                'is_custom' => false,
            ],
            [
                'name' => 'performance-test',
                'is_custom' => false,
            ],
            [
                'name' => 'load-test',
                'is_custom' => false,
            ],
            [
                'name' => 'stress-test',
                'is_custom' => false,
            ],
            [
                'name' => 'usability-test',
                'is_custom' => false,
            ],
            [
                'name' => 'security-test',
                'is_custom' => false,
            ],
            [
                'name' => 'compatibility-test',
                'is_custom' => false,
            ],
            [
                'name' => 'exploratory-test',
                'is_custom' => false,
            ],
            [
                'name' => 'a/b-test',
                'is_custom' => false,
            ],
        ]);
        

        \DB::table('test_status')->insert([
            ['status' => 'pending'],
            ['status' => 'passed'],
            ['status' => 'failed'],
            ['status' => 'skipped'],
        ]);

        // Crear un usuario
        $user = User::create([
            'first_name' => 'John',
            'last_name' => 'Doe',
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => 'password',
            'role_id' => 2,
        ]);

        // Crear un proyecto
        $project = Project::create([
            'project_name' => 'Project Alpha',
            'description' => 'Test project',
        ]);

        $module = ProjectModule::create([
            'module_name' => 'Module 1',
            'project_id' => $project->id,
        ]);

        $task = ProjectTask::create([
            'name' => 'Task 1',
            'module_id' => $module->id,
            'project_id' => $project->id,
        ]);

        // Asignar un usuario a la tarea
        TaskAssignees::create([
            'task_id' => $task->id,
            'user_id' => $user->id,
        ]);

        // Crear un caso de prueba
        $testCase = TestCase::create([
            'descriptive_id' => 'TC001',
            'title' => 'Test Case 1',
            'description' => 'Test case description',
            'steps' => ['Step 1', 'Step 2', 'Step 3'],
            'expected_behaviour' => 'Expected result',
            'obtained_result' => 'Obtained result',
            'test_comments' => 'Initial comment',
            'is_published' => false,
            'created_by' => $user->id,
            'task_id' => $task->id,
            'test_type' => 1, 
            'test_status' => 1, 
        ]);

        $parent = CaseComment::create([
            'comment' => 'This is a comment on the test case.',
            'user_id' => $user->id,
            'test_case_id' => $testCase->id,
        ]);

        CaseComment::create([
            'comment' => 'This is another comment from the same user. but is reponsed to the first comment.',
            'user_id' => $user->id,
            'test_case_id' => $testCase->id,
            'parent_id'=> $parent->id
        ]);

        // Crear un informe de error (bug report)
        BugReport::create([
            'title' => 'Bug in task',
            'description' => 'Bug found in task execution',
            'steps_to_reproduce' => ['Step 1', 'Step 2', 'Step 3'],
            'task_id' => $task->id,
            'created_by' => $user->id,
        ]);
    }
}
