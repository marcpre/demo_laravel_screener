<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Markets extends Model
{
    protected $fillable = ['exchanges_id', 'instruments_id', 'symbol', 'base', 'quote'];
}
