<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestType extends Model
{
    protected $table = "test_type";
    public $timestamps = false;
    protected $fillable = [
        "test_type",
    ];

    protected $casts = [
        "is_custom" => "boolean",
    ];

    protected $hidden = ["id"];
}
