<?php

namespace App\Models;

use App\Models\Support\Trashable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class ProjectModule extends Model
{
    use HasUuids, Trashable;
    protected $table = "project_modules";

    protected $fillable = [
        'module_name',
        'color',
        'project_id'
    ];

    protected $hidden = ['project_id', 'deleted'];

    protected $casts = [
        'deleted' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at'=> 'datetime',
    ];
}
