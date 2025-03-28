<?php

namespace App\Models;

use App\Models\Support\Trashable;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasUlids, Trashable;
    protected $table = "projects";
    protected $fillable = [
        "project_name",
        "description",
    ];

    protected $hidden = ["deleted"];
    
    protected $casts = [
        "created_at" => "datetime",
        "updated_at" => "datetime",
        "deleted_at" => "datetime",
        "deleted" => "boolean",
    ];
}
