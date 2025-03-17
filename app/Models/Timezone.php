<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timezone extends Model
{
    protected $timestamps = false;
    public $table = 'timezones';
    protected $fillable = [ 'code', 'name' ];
}
