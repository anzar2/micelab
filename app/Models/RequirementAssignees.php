<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequirementAssignees extends Model
{
    protected $table = "requirements_assignees";
    public $timestamps = false;
    protected $fillable = [
        "requirement_id",
        "user_id",
    ];

    protected $hidden = [
        "id",
        "requirement_id",
        "user_id",
    ];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }
    public function projectTask(): BelongsTo {
        return $this->belongsTo(ProjectRequirement::class,"requirement_id");
    }
}

