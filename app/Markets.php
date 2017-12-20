<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Markets extends Model
{
    protected $fillable = ['exchanges_id', 'symbol', 'base', 'quote'];
}
