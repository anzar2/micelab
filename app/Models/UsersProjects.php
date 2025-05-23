<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UsersProjects extends Model
{
    protected $table = "users_projects";
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'project_id',
    ];

    protected $hidden = [
        'id',
        'user_id',
        'project_id',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }

    public function project(): BelongsTo {
        return $this->belongsTo(Project::class, "project_id");
    }
}
