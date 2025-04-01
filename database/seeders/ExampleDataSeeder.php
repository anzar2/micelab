<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\BugComments;
use App\Models\BugReport;
use App\Models\CaseComment;
use App\Models\Project;
use App\Models\ProjectModule;
use App\Models\ProjectRequirement;
use App\Models\RequirementAssignees;
use App\Models\TestCase;
use App\Models\User;
use App\Models\UsersProjects;
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
                    'display_name' => 'John Doe',
                    'username' => 'johndoe',
                    'email' => 'johndoe@example.com',
                    'password' => 'password',
                    'global_role' => "developer",
                ]);

                $user_2 = User::create([
                    'display_name' => 'Sara Doe',
                    'username' => 'saradoe',
                    'email' => 'saradoe@example.com',
                    'password' => 'password',
                    'global_role' => "developer",
                ]);

                $project = Project::create([
                    'name' => __('seeder.project.name'),
                    'description' => __('seeder.project.description'),
                ]);

                UsersProjects::create([
                    'user_id' => $user_1->id,
                    'project_id' => $project->id,
                ]);

                UsersProjects::create([
                    'user_id' => $user_2->id,
                    'project_id' => $project->id,
                ]);

                $module = ProjectModule::create([
                    'name' => __('seeder.module.name'),
                    'project_id' => $project->id,
                    'color' => '#ff0000',
                ]);

                $requirement = ProjectRequirement::create([
                    'name' => __('seeder.task.name'),
                    'module_id' => $module->id,
                    'description' => __('seeder.task.description'),
                    'project_id' => $project->id,
                    'expected_flow' => __('seeder.task.expected_flow'),
                ]);

                RequirementAssignees::create([
                    'requirement_id' => $requirement->id,
                    'user_id' => $user_1->id,
                ]);

                $testCase = TestCase::create([
                    'title' => __('seeder.testCase.title'),
                    'description' => __('seeder.testCase.description'),
                    'steps' => __('seeder.testCase.steps'),
                    'obtained_result' => __('seeder.testCase.obtained_result'),
                    'test_comments' => __('seeder.testCase.test_comments'),
                    'is_published' => true,
                    'created_by' => $user_1->id,
                    'requirement_id' => $requirement->id,
                    'test_type' => 1,
                    'test_status' => 1,
                ]);

                $comment_1 = CaseComment::create([
                    'comment' => __('seeder.testCaseComment.comment_1'),
                    'user_id' => $user_1->id,
                    'test_case_id' => $testCase->id,
                ]);

                $comment_2 = CaseComment::create([
                    'comment' => __('seeder.testCaseComment.comment_2'),
                    'user_id' => $user_2->id,
                    'test_case_id' => $testCase->id,
                ]);

                $comment_3 = CaseComment::create([
                    'comment' => __('seeder.testCaseComment.comment_3'),
                    'user_id' => $user_2->id,
                    'test_case_id' => $testCase->id,
                    'parent_id' => $comment_1->id
                ]);

                $comment_4 = CaseComment::create([
                    'comment' => __('seeder.testCaseComment.comment_4'),
                    'user_id' => $user_1->id,
                    'test_case_id' => $testCase->id,
                    'parent_id' => $comment_2->id
                ]);


                $bug_report = BugReport::create([
                    'title' => __('seeder.bugReport.title'),
                    'description' => __('seeder.bugReport.description'),
                    'steps_to_reproduce' => __('seeder.bugReport.steps_to_reproduce'),
                    'requirement_id' => $requirement->id,
                    'project_id' => $project->id,
                    'created_by' => $user_2->id,
                ]);


                $bug_report_comment_1 = BugComments::create([
                    'comment' => __('seeder.bugReportComment.comment_1'),
                    'user_id' => $user_1->id,
                    'bug_report_id' => $bug_report->id,
                ]);

                $bug_report_comment_2 = BugComments::create([
                    'comment' => __('seeder.bugReportComment.comment_2'),
                    'user_id' => $user_2->id,
                    'bug_report_id' => $bug_report->id,
                ]);

                // Replies to bug report comments
                BugComments::create([
                    'comment' => __('seeder.bugReportComment.comment_3'),
                    'user_id' => $user_1->id,
                    'bug_report_id' => $bug_report->id,
                    'parent_id' => $bug_report_comment_1->id
                ]);
                BugComments::create([
                    'comment' => __('seeder.bugReportComment.comment_4'),
                    'user_id' => $user_2->id,
                    'bug_report_id' => $bug_report->id,
                    'parent_id' => $bug_report_comment_2->id
                ]);

                ActivityLog::insert([
                    [
                        'action' => 'create',
                        'subject_type' => 'project_requirement',
                        'subject_id' => $requirement->id,
                        'by' => $user_1->id,
                    ],
                    [
                        'action' => 'create',
                        'subject_type' => 'test_case',
                        'subject_id' => $testCase->id,
                        'by' => $user_1->id,
                    ],
                    [
                        'action' => 'create',
                        'subject_type' => 'case_comment',
                        'subject_id' => $comment_1->id,
                        'by' => $comment_1->user->id,
                    ],
                    [
                        'action' => 'create',
                        'subject_type' => 'case_comment',
                        'subject_id' => $comment_2->id,
                        'by' => $comment_2->user->id,
                    ],
                    [
                        'action' => 'create',
                        'subject_type' => 'case_comment',
                        'subject_id' => $comment_3->id,
                        'by' => $comment_3->user->id,
                    ],
                    [
                        'action' => 'create',
                        'subject_type' => 'case_comment',
                        'subject_id' => $comment_4->id,
                        'by' => $comment_4->user->id,
                    ],
                    [
                        'action' => 'create',
                        'subject_type' => 'bug_report',
                        'subject_id' => $bug_report->id,
                        'by' => $bug_report->created_by,
                    ],
                    [
                        'action' => 'create',
                        'subject_type' => 'bug_comment',
                        'subject_id' => $bug_report_comment_1->id,
                        'by' => $bug_report_comment_1->user->id,
                    ],
                    [
                        'action' => 'create',
                        'subject_type' => 'bug_comment',
                        'subject_id' => $bug_report_comment_2->id,
                        'by' => $bug_report_comment_2->user->id,
                    ],
                ]);
            }
        }

    }
}

