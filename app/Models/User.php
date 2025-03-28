<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Support\Trashable;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids, Trashable;

    
    protected $table = "users";
    public $incrementing = false;

    // Avaiable fields for massive assignments
    protected $fillable = [
        'display_name',
        'username',
        'email',
        'password',
        'global_role',
    ];
    // Hidden fields on JSON responses
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
        'user_preferences',
        'deleted',
    ];

    protected $guarded = ['global_role'];

    // Simple casts
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at'=> 'datetime',
            'deleted_at'=> 'datetime',
            'deleted'=> 'boolean',
            'password' => 'hashed',
        ];
    }

    // Mutators
    protected function displayName(): Attribute {
        return Attribute::make(
            get: fn (string $value) => ucwords(strtolower($value)),
            set: fn (string $value) => strtolower($value),
        );
    }

    public function preferences (): HasOne {
        return $this->hasOne(UserPreference::class)->with('timezone');
    }

    public function globalRole(): BelongsTo {
        return $this->belongsTo(UserRole::class, 'global_role');
    }
}
