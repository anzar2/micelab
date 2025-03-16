<?php

namespace App\Observers;

use App\Models\TestCase;

class TestCaseObserver
{
    public function created(TestCase $testCase)
    {
        $testCase->descriptive_id = "TC-" . str_pad($testCase->count(), 4, "0", STR_PAD_LEFT);
        $testCase->save();
    }
}
