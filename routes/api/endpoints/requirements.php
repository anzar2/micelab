<?php
use App\Http\Controllers\RequirementsController;

// This routes are protected with auth middleware

Route::prefix("projects/{project_id}/requirements")->middleware(["isProjectMember", "globalrole:admin,developer,owner"])
    ->group(function () {
        Route::get("", [RequirementsController::class, "index"]);
        Route::get("{requirement_id}", [RequirementsController::class, "show"]);

        Route::middleware("csrf")->group(function () {
            Route::post("", [RequirementsController::class, "store"]);
            Route::post("{requirement_id}/assign", [RequirementsController::class, "assign"]);
            Route::put("{requirement_id}", [RequirementsController::class, "update"]);

            Route::patch("{requirement_id}/trash", [RequirementsController::class, "trash"]);
            Route::patch("{requirement_id}/recover", [RequirementsController::class, "recover"]);

            Route::delete("{requirement_id}", [RequirementsController::class, "destroy"]);
        });
    });