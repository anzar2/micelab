<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Observers\UserObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;

#[ObservedBy([UserObserver::class])]
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasUuids;

    
    protected $table = "users";
    public $incrementing = false;

    // Avaiable fields for massive assignments
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
    ];
    // Hidden fields on JSON responses
    protected $hidden = [
        'role_id',
        'password',
        'remember_token',
        'email_verified_at',
        'user_preferences',
        'deleted',
    ];

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
    protected function firstName(): Attribute {
        return Attribute::make(
            get: fn (string $value) => ucfirst(strtolower($value)),
            set: fn (string $value) => strtolower($value),
        );
    }

    protected function lastName(): Attribute {
        return Attribute::make(
            get: fn (string $value) => ucfirst(strtolower($value)),
            set: fn (string $value) => strtolower($value),
        );
    }

    // Relations
    public function privileges(): BelongsTo {
        return $this->belongsTo(UserRole::class, 'role_id');
    }

    public function preferences (): BelongsTo {
        return $this->belongsTo(UserPreference::class, 'user_preferences');
    }
}
