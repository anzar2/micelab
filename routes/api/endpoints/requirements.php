<?php
use App\Http\Controllers\RequirementsController;

// This routes are protected with auth middleware

Route::prefix("projects/{project}/requirements")->middleware(["isProjectMember", "globalrole:admin,developer,owner"])
    ->group(function () {
        Route::get("", [RequirementsController::class, "index"]);
        Route::get("{requirement}", [RequirementsController::class, "show"]);

        Route::middleware("csrf")->group(function () {
            Route::post("", [RequirementsController::class, "store"]);
            Route::post("{requirement}/assign", [RequirementsController::class, "assign"]);
            Route::put("{requirement}", [RequirementsController::class, "update"]);

            Route::patch("{requirement}/trash", [RequirementsController::class, "trash"]);
            Route::patch("{requirement}/recover", [RequirementsController::class, "recover"]);

            Route::delete("{requirement}", [RequirementsController::class, "destroy"]);
        });
    });