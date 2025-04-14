<?php

namespace App\Models;


use App\Observers\CaseCommentLog;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[ObservedBy([CaseCommentLog::class])]
class CaseComment extends Model
{
    protected $table = "test_cases_comments";
   

    protected $fillable = [
        "case_comment",
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
        return $this->hasMany(CaseComment::class, "parent_id")->with(["replies", "user"]);
    }
}
