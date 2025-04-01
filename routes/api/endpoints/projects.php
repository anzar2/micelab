<?php
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UsersProjectsController;

// This routes are protected with auth middleware

Route::prefix("projects")->group(function () {
    Route::middleware("globalrole:owner,admin,developer")->group(function () {
        Route::get("", [ProjectsController::class, "index"]);
        Route::get("{project}", [ProjectsController::class, "show"])->middleware("isProjectMember");
    });

    Route::middleware(["csrf", "globalrole:owner,admin"])->group(function () {
        Route::post("", [ProjectsController::class, "store"]);
        Route::put("{project}", [ProjectsController::class, "update"]);
        Route::patch("{project}/trash", [ProjectsController::class, "trash"]);
        Route::patch("{project}/recover", [ProjectsController::class, "recover"]);
        Route::delete("{project}", [ProjectsController::class, "destroy"]);
    });
});

Route::prefix("projects/{project}/users")->middleware(["isProjectMember"])->group(function () {
    Route::middleware("globalrole:owner,admin,developer")->group(function () {
        Route::get("", [UsersProjectsController::class, "index"]);
        Route::get("{user}", [UsersProjectsController::class, "show"]);
    });

    Route::middleware(["csrf", "globalrole:owner,admin"])->group(function () {
        Route::post("", [UsersProjectsController::class, "store"]);
        Route::delete("{user}", [UsersProjectsController::class, "destroy"]);
        Route::delete("", [UsersProjectsController::class, "clean"]);
    });
});

