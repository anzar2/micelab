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

    protected $hidden = ["parent_id", "user_id"]; 

    protected $casts = [
        "created_at"=> "datetime",
        "updated_at"=> "datetime",
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, "user_id");
    }

    public function replies() {
        return $this->hasMany(CaseComment::class, "parent_id");
    }
}
