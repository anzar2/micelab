<?php

namespace App\Models;

use App\Observers\TestCaseObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use \Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[ObservedBy([TestCaseObserver::class])]
class TestCase extends Model
{
    use HasUlids;
    protected $table = "test_case";
    protected $subject_name = "test_case";

    protected $fillable = [
        "descriptive_id",
        "title",
        "description",
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
        'deleted_at'=> 'datetime',
        'created_at'=> 'datetime',
        'updated_at'=> 'datetime',
    ];

    protected $hidden = ["deleted", "created_by"];

    protected function steps(): Attribute {
        return Attribute::make(
            get: fn($value) => unserialize($value),
            set: fn($value) => serialize($value),
        );
    }

    protected function preConditions(): Attribute {
        return Attribute::make(
            get: fn($value) => unserialize($value),
            set: fn($value) => serialize($value),
        );
    }

    public function projectTask(): BelongsTo {
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
