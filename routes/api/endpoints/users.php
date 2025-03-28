<?php
use App\Http\Controllers\MeController;
use App\Http\Controllers\UpdateRoleController;
use App\Http\Controllers\UsersController;

// This routes are protected with auth middleware

Route::prefix("users/@me")->group(function () {
    Route::get("", [MeController::class, "get"]);
});

Route::prefix("users")->group(function () {
    Route::middleware("globalrole:owner,admin")->group(function () {
        Route::get("", [UsersController::class, "all"]);
        Route::get("search", [UsersController::class, "search"]);
        Route::get("{user_id}", [UsersController::class, "get"]);
        Route::post("", [UsersController::class, "store"]);
        Route::put("{user_id}", [UsersController::class, "update"]);
        Route::patch("{user_id}/recover", [UsersController::class, "recover"]);
        Route::patch("{user_id}/trash", [UsersController::class, "trash"])->middleware("protectOwnership");
        Route::delete("{user_id}", [UsersController::class, "delete"])->middleware("protectOwnership");
    });

    Route::patch("{user_id}/role", [UpdateRoleController::class, "update_role"])
        ->middleware(["csrf", "globalrole:owner", "protectOwnership"]);
});