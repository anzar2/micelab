<?php

use App\Http\Controllers\BugCommentsController;
use App\Http\Controllers\BugReportsController;

// This routes are protected with auth middleware

Route::prefix("projects/{project}/bug-reports")
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

Route::prefix("projects/{project}/bug-reports/{bug_report}/comments")
    ->middleware(["isProjectMember"])
    ->group(function () {
        Route::get("", [BugCommentsController::class, "index"]);

        Route::middleware(["csrf"])->group(function () {
            Route::post("", [BugCommentsController::class, "store"]);
            Route::patch("{comment}", [BugCommentsController::class, "update"]);
            Route::delete("{comment}", [BugCommentsController::class, "destroy"]);
        });
    });