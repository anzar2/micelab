<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = "user_roles";
    protected $primaryKey = "name";
    public $timestamps = false;

    protected $casts = [
        'name' => 'string',
    ];
}
