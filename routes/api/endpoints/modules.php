<?php
use App\Http\Controllers\ModulesController;

// This routes are protected with Auth middleware

Route::prefix("projects/{project}/modules")
    ->middleware(["isProjectMember", "globalrole:admin,developer,owner"])
    ->group(function () {
        Route::get("", [ModulesController::class, "index"]);
        Route::get("{module}", [ModulesController::class, "show"]);

        Route::middleware("csrf")->group(function () {
            Route::post("", [ModulesController::class, "store"]);
            Route::put("{module}", [ModulesController::class, "update"]);

            Route::patch("{module}/trash", [ModulesController::class, "trash"]);
            Route::patch("{module}/recover", [ModulesController::class, "recover"]);

            Route::delete("{module}", [ModulesController::class, "destroy"]);
        });
    });