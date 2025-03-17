<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = "themes";
    public $timestamps = false;
    protected $fillable = ['code'];
}
