<?php
// All these routes has /api prefix

// Generates the CSRF token by API
Route::get("/csrf-token", function () {
    return response()->json(["_token" => csrf_token()]);
});

// 404 Fallback
Route::fallback(function () {
    return response()->json([
        "status" => 404,
        "message" => "resource out of scope",
    ], 404);
});

// All new API routes endpoints should be included below.
// Note: I recommend you to check ./app/Services/WriteService.php before adding new endpoints, may be useful
Route::middleware(["auth"])->group(function () {
    include_once __DIR__ ."/endpoints/projects.php";
    include_once __DIR__ ."/endpoints/users.php";
    include_once __DIR__ ."/endpoints/modules.php";
    include_once __DIR__ ."/endpoints/requirements.php";
    include_once __DIR__ ."/endpoints/test_cases.php";
    include_once __DIR__ ."/endpoints/bug_reports.php";
});