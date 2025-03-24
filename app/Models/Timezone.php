<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    public $timestamps = false;
    public $table = 'timezones';
    protected $fillable = [ 'code', 'name' ];
}
