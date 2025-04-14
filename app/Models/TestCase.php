<?php

namespace App\Models;

use App\Models\Support\Trashable;
use App\Observers\TestCaseObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use \Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[ObservedBy([TestCaseObserver::class])]
class TestCase extends Model
{
    use HasUlids, Trashable;
    protected $table = "test_cases";

    protected $fillable = [
        "descriptive_id",
        "case_title",
        "case_description",
        "steps",
        "obtained_result",
        "test_comments",
        'is_published',
        "duration_in_seconds",
        "test_version",
        "pre_conditions",
        "is_automated",
        "created_by",
        "requirement_id",
        "test_type",
        "test_status",
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'deleted'=> 'boolean',
        'steps' => 'array',
        'pre_conditions' => 'array',
        'deleted_at'=> 'datetime',
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    protected $hidden = ["deleted", "created_by"];

    public function requirement(): BelongsTo {
        return $this->belongsTo(ProjectRequirement::class, "requirement_id");
    }

    public function testType(): BelongsTo {
        return $this->belongsTo(TestType::class, "test_type");
    }

    public function testStatus(): BelongsTo {
        return $this->belongsTo(TestStatus::class, "test_status");
    }

    public function createdBy(): BelongsTo {
        return $this->belongsTo(User::class, "created_by");
    }
}
