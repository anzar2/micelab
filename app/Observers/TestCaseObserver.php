<?php

namespace App\Observers;

use App\Models\TestCase;

class TestCaseObserver
{   
    /**
     * Creates a descriptive based on: First letter of project name + last letter of project name + "-" + count of test cases
     * @param \App\Models\TestCase $testCase
     * @return void
     */
    public function created(TestCase $testCase)
    {
        $project_name = $testCase->projectTask->project->project_name;
        $descriptive_id = 
        "TC".
        substr(strtoupper($project_name),0,1).
        substr(strtoupper($project_name),-1,1).
        "-".
        str_pad($testCase->count(), 4, "0", STR_PAD_LEFT);

        $testCase->descriptive_id = $descriptive_id;
        $testCase->save();
    }
}
