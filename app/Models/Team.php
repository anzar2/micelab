<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public $timestamps = false;
    protected $table = "teams";
    protected $fillable = [
        'team_name',
    ];
}
