<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['instruments_id', 'revisions_id', 'contributors_id', 'name', 'link', 'date' ];
    
}
