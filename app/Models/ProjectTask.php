<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectTask extends Model
{
    use HasUlids;

    protected $table = "project_tasks";
    protected $fillable = [
        'name',
        'module_id',
        'status',
        'project_id'
    ];

    protected $hidden = ["deleted"];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at'=> 'datetime',
        'deleted_at'=> 'datetime',
        'deleted'=> 'boolean',
    ];
    public function projectModule(): BelongsTo {
        return $this->belongsTo(ProjectModule::class, 'module_id');
    }
    
    public function assignees(): HasMany {
        return $this->hasMany(TaskAssignees::class, 'task_id');
    }
}
