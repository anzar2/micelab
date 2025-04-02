<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Models\TestCase;
use Illuminate\Support\Facades\Auth;

class TestCaseObserver
{   
    /**
     * Creates a descriptive based on: First letter of project name + last letter of project name + "-" + count of test cases (This must be improved)
     * 
     * And register the log
     * @param \App\Models\TestCase $testCase
     * @return void
     */
    public function created(TestCase $testCase)
    {
        $project_name = $testCase->requirement->project->project_name;
        $descriptive_id = 
        "TC".
        substr(strtoupper($project_name),0,1).
        substr(strtoupper($project_name),-1,1).
        "-".
        str_pad($testCase->count(), 4, "0", STR_PAD_LEFT);

        $testCase->descriptive_id = $descriptive_id;
        $testCase->save();

        ActivityLog::create([
            "action" => "create",
            "subject_type" => "test_case",
            "subject_id" => $testCase->id,
            "by" => Auth::id(),
            "when" => now()
        ]);
    }

    public function updated(TestCase $testCase) {
        ActivityLog::create([
            "action" => "update",
            "subject_type" => "test_case",
            "subject_id" => $testCase->id,
            "by" => Auth::id(),
            "when" => now()
        ]);
    }
    public function deleted(TestCase $testCase) {
        ActivityLog::create([
            "action" => "delete",
            "subject_type" => "test_case",
            "subject_id" => $testCase->id,
            "by" => Auth::id(),
            "when" => now()
        ]);
    }
}
