<?php

namespace Database\Seeders;

use App\Models\BugReport;
use App\Models\CaseComment;
use App\Models\Project;
use App\Models\ProjectModule;
use App\Models\ProjectTask;
use App\Models\TaskAssignees;
use App\Models\TestCase;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate development data on development mode
        if (config('app.example_insert')) { {
                $user_1 = User::create([
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'username' => 'johndoe',
                    'email' => 'johndoe@example.com',
                    'password' => 'password',
                    'role_id' => 2,
                ]);

                $user_2 = User::create([
                    'first_name' => 'Sara',
                    'last_name' => 'Doe',
                    'username' => 'saradoe',
                    'email' => 'saradoe@example.com',
                    'password' => 'password',
                    'role_id' => 2,
                ]);

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

                TaskAssignees::create([
                    'task_id' => $task->id,
                    'user_id' => $user_1->id,
                ]);

                $testCase = TestCase::create([
                    'title' => 'Test Case 1',
                    'description' => 'Test case description',
                    'steps' => ['Step 1', 'Step 2', 'Step 3'],
                    'expected_behaviour' => 'Expected result',
                    'obtained_result' => 'Obtained result',
                    'test_comments' => 'Initial comment',
                    'is_published' => false,
                    'created_by' => $user_1->id,
                    'task_id' => $task->id,
                    'test_type' => 1,
                    'test_status' => 1,
                ]);

                $comment_1 = CaseComment::create([
                    'comment' => 'This is a comment on the test case. It is the first comment.',
                    'user_id' => $user_1->id,
                    'test_case_id' => $testCase->id,
                ]);

                $comment_2 = CaseComment::create([
                    'comment' => 'This is another comment on the test case from different user.',
                    'user_id' => $user_2->id,
                    'test_case_id' => $testCase->id,
                ]);
                
                // Replies
                CaseComment::create([
                    'comment' => "I don't think you tell the truth",
                    'user_id' => $user_2->id,
                    'test_case_id' => $testCase->id,
                    'parent_id' => $comment_1->id
                ]);
                CaseComment::create([
                    'comment' => 'I trust you',
                    'user_id' => $user_1->id,
                    'test_case_id' => $testCase->id,
                    'parent_id' => $comment_2->id
                ]);

                BugReport::create([
                    'title' => 'Bug in task',
                    'description' => 'Bug found in task execution',
                    'steps_to_reproduce' => ['Step 1', 'Step 2', 'Step 3'],
                    'task_id' => $task->id,
                    'created_by' => $user_1->id,
                ]);
            }
        }

    }
}
