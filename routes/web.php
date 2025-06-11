<?php
use App\Http\Controllers\AppController;
use App\Http\Controllers\LoginController;

// All API routes consumed by Micelab
Route::prefix("api")->group(function () {
    include_once __DIR__ . "/api/api.php";
});

// Always redirect to app
Route::redirect("/", "/app");

// Only load Micelab application if user is authenticated
Route::middleware(["auth"])->group(function () {
    Route::get("/app", [AppController::class,"index"])->name("");
    Route::get("/app/{any}", [AppController::class, "index"])->where("any", ".*");
});

// Login
Route::get("/login", [LoginController::class, 'index'])
    ->name("login");
Route::post("/login", [LoginController::class, 'login'])
    ->name("login.attempt");