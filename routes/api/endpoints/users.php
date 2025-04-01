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
        Route::get("", [UsersController::class, "index"]);
        Route::get("search", [UsersController::class, "search"]);
        Route::get("{user}", [UsersController::class, "show"]);
    });

    Route::middleware(["csrf", "globalrole:owner,admin"])->group(function () {
        Route::post("", [UsersController::class, "store"]);
        Route::patch("{user}/recover", [UsersController::class, "recover"]);
        Route::patch("{user}/trash", [UsersController::class, "trash"])->middleware("protectOwnership");
    });

    Route::middleware(["csrf", "globalrole:owner"])->group(function () {
        Route::put("{user}", [UsersController::class, "update"]);
        Route::patch("{user}/role", [UpdateRoleController::class, "update_role"])->middleware("protectOwnership");
        Route::delete("{user}", [UsersController::class, "destroy"])->middleware("protectOwnership");
    });
});