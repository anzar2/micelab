<?php

use App\Http\Controllers\CaseCommentsController;
use App\Http\Controllers\TestCaseController;

// This routes are protected with Auth middleware

Route::prefix("projects/{project}/requirements/{requirement}/test-cases")
    ->middleware(["isProjectMember"])
    ->group(function () {
        Route::get("", [TestCaseController::class, "index"]);
        Route::get("{test_case}", [TestCaseController::class, "show"]);

        Route::middleware(["csrf"])->group(function () {
            Route::post("", [TestCaseController::class, "store"]);
            Route::put("{test_case}", [TestCaseController::class, "update"]);
            Route::delete("{test_case}", [TestCaseController::class, "destroy"]);
            Route::patch("{test_case}/trash", [TestCaseController::class, "trash"]);
            Route::patch("{test_case}/recover", [TestCaseController::class, "recover"]);
            Route::patch("{test_case}/publish", [TestCaseController::class, "publish"]);
            Route::patch("{test_case}/unpublish", [TestCaseController::class, "unpublish"]);
        });
    });

Route::prefix("projects/{project}/requirements/{requirement}/test-cases/{test_case}/comments")
    ->middleware(["isProjectMember"])
    ->group(function () {
        Route::get("", [CaseCommentsController::class, "index"]);

        Route::middleware(["csrf"])->group(function () {
            Route::post("", [CaseCommentsController::class, "store"]);
            Route::patch("{comment}", [CaseCommentsController::class, "update"]);
            Route::delete("{comment}", [CaseCommentsController::class, "destroy"]);
        });
    });