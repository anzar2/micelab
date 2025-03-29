<?php
use App\Http\Controllers\ModulesController;

// This routes are protected with Auth middleware

Route::prefix("projects/{project_id}/modules")
    ->middleware(["isProjectMember", "globalrole:admin,developer,owner"])
    ->group(function () {
        Route::get("", [ModulesController::class, "index"]);
        Route::get("{module_id}", [ModulesController::class, "show"]);

        Route::middleware("csrf")->group(function () {
            Route::post("", [ModulesController::class, "store"]);
            Route::put("{module_id}", [ModulesController::class, "update"]);

            Route::patch("{module_id}/trash", [ModulesController::class, "trash"]);
            Route::patch("{module_id}/recover", [ModulesController::class, "recover"]);

            Route::delete("{module_id}", [ModulesController::class, "destroy"]);
        });
    });