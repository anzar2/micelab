<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPreference extends Model
{
    protected $table = "user_preferences";
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'theme',
        'language',
        'timezone',
    ];

    protected $hidden = [
        'user_id',
        'id',
    ];

    public function timezone(): BelongsTo {
        return $this->belongsTo(Timezone::class, 'timezone', 'code');
    }
}
