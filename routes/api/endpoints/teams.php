<?php
use App\Models\Team;

Route::prefix("teams")->group(function () {
    Route::get("", function () {
        return response()->json(Team::first());
    });
});
