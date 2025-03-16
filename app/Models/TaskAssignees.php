<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskAssignees extends Model
{
    protected $table = "tasks_assignees";
    public $timestamps = false;
    protected $fillable = [
        "task_id",
        "user_id",
    ];

    protected $hidden = [
        "id",
        "task_id",
        "user_id",
    ];

    public function users(): BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }
    public function projectTask(): BelongsTo {
        return $this->belongsTo(ProjectTask::class,"task_id");
    }
}
