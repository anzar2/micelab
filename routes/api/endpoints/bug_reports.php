<?php

use App\Http\Controllers\BugReportsController;

// This routes are protected with auth middleware

Route::prefix("projects/{project}/bug_reports")
    ->middleware(["isProjectMember"])
    ->group(function () {
        Route::get("", [BugReportsController::class, "index"]);
        Route::get("{bug_report}", [BugReportsController::class, "show"]);

        Route::middleware(["csrf"])->group(function () {
            Route::post("", [BugReportsController::class, "store"]);
            Route::put("{bug_report}", [BugReportsController::class, "update"]);
            Route::delete("{bug_report}", [BugReportsController::class, "destroy"]);
        });
    });