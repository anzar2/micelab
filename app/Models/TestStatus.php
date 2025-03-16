<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestStatus extends Model
{
    protected $table = "test_status";
    public $timestamps = false;
    protected $fillable = [
        "status",
    ];

    protected $hidden = ["id"];
}
