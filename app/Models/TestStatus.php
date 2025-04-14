<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestStatus extends Model
{
    protected $table = "test_status";
    public $timestamps = false;
    protected $fillable = [
        "test_status",
    ];

    protected $hidden = ["id"];
}
