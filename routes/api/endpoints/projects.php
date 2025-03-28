<?php
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\UsersProjectsController;

// This routes are protected with auth middleware

Route::prefix("projects")->group(function () {
    Route::get("", [ProjectsController::class, "all"]);
    Route::get("{project_id}", [ProjectsController::class, "get"])->middleware("isProjectMember");

    Route::middleware(["csrf", "globalrole:owner,admin"])->group(function () {
        Route::post("", [ProjectsController::class, "store"]);
        Route::put("{project_id}", [ProjectsController::class, "update"]);
        Route::patch("{project_id}/trash", [ProjectsController::class, "trash"]);
        Route::patch("{project_id}/recover", [ProjectsController::class, "recover"]);
        Route::delete("{project_id}", [ProjectsController::class, "delete"]);
    });
});

Route::prefix("projects/{project_id}/users")->middleware(["isProjectMember"])->group(function () {
    Route::get("", [UsersProjectsController::class, "all"]);
    Route::get("{user_id}", [UsersProjectsController::class, "get"]);
    Route::delete("leave", [UsersProjectsController::class, "leave"]);

    Route::middleware(["csrf", "globalrole:owner,admin"])->group(function () {
        Route::post("{user_id}", [UsersProjectsController::class, "store"]);
        Route::delete("{user_id}", [UsersProjectsController::class, "delete"]);
        Route::delete("", [UsersProjectsController::class, "clean"]);
    });
});

