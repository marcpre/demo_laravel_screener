<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruments extends Model
{
    protected $fillable = ['name', 'symbol', 'image', 'created_at', 'updated_at'];
}
