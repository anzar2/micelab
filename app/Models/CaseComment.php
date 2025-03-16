<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CaseComment extends Model
{
    protected $table = "test_case_comments";
    protected $fillable = [
        "comment",
        "user_id",
        "test_case_id",
        "parent_id",
    ];

    protected $casts = [
        "created_at"=> "datetime",
        "updated_at"=> "datetime",
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, "id");
    }

    public function parent(): BelongsTo {
        return $this->belongsTo(CaseComment::class, "parent_id");
    }
}
