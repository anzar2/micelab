<?php

use App\Http\Controllers\TestCaseController;

// This routes are protected with Auth middleware

Route::prefix("projects/{project_id}/requirements/{requirement_id}/test-cases")
    ->middleware(["isProjectMember"])
    ->group(function () {
        Route::get("", [TestCaseController::class, "index"]);
        Route::get("{test_case_id}", [TestCaseController::class, "show"]);

        Route::middleware(["csrf"])->group(function () {
            Route::post("", [TestCaseController::class, "store"]);
            Route::put("{test_case_id}", [TestCaseController::class, "update"]);
            Route::delete("{test_case_id}", [TestCaseController::class, "destroy"]);
            Route::patch("{test_case_id}", [TestCaseController::class, "trash"]);
            Route::patch("{test_case_id}", [TestCaseController::class, "recover"]);
        });
    });