<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ActivityLog extends Model
{
    protected $table = "activity_log";
    public $timestamps = false;
    protected $fillable = [
        "action",
        "subject_id",
        "subject_type",
        "by",
        "when",
    ];

    protected $hidden = [
        "subject_id",
        "id",
    ];

    protected $casts = [
        "when" => "datetime",
    ];

    public function by(): BelongsTo {
        return $this->belongsTo(User::class, 'by');
    }

    public function subject():MorphTo {
        return $this->morphTo();
    }
}
