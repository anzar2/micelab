<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = "user_roles";
    public $timestamps = false;
    protected $hidden = [
        'id',
        'can_create_project',
        'can_delete_project',
        'can_manage_users'
    ];
    protected $guarded = [
        'privilege_name',
        'can_create_project',
        'can_delete_project',
        'can_manage_users'
    ];
}
