<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;


class BugReport extends Model
{
    use HasUlids;
    protected $table = "bug_reports";
    protected $fillable = [
        "title",
        "description",
        "steps_to_reproduce",
        "task_id",
        "created_by",
    ];

    protected $casts = [
        "created_at"=> "datetime",
        "updated_at"=> "datetime",
    ];

    public function stepsToReproduce(): Attribute {
        return Attribute::make(
            get: fn($value) => json_decode($value),
            set: fn($value) => json_encode($value),
        );
    }
}
