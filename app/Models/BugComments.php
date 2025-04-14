<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class BugComments extends Model
{   
    protected $table = "bug_report_comments";
    protected $fillable = [
        "bug_comment",
        "user_id",
        "bug_report_id",
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
        return $this->hasMany( BugComments::class, "parent_id")->with('replies');
    }
}
