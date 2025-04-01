<?php

namespace App\Models;

use App\Models\Support\Trashable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class ProjectRequirement extends Model
{
    use HasUlids, Trashable;
 
    protected $table = "project_requirements";
    protected $fillable = [
        'name',
        'description',
        'expected_flow',
        'module_id',
        'project_id'
    ];

    protected $hidden = ["deleted", "module_id", "project_id"];

    protected $casts = [
        'expected_flow' => 'array',
        'created_at' => 'datetime',
        'updated_at'=> 'datetime',
        'deleted_at'=> 'datetime',
        'deleted'=> 'boolean',
    ];
    public function module(): BelongsTo {
        return $this->belongsTo(ProjectModule::class, 'module_id');
    }

    public function project(): BelongsTo {
        return $this->belongsTo(Project::class,'project_id');
    }
    
    public function assignees(): HasMany {
        return $this->hasMany(RequirementAssignees::class, 'requirement_id')->with('user');
    }

    public function activityLogs(): MorphMany
    {
        return $this->morphMany(ActivityLog::class, 'subject');
    }
}

