<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = ['instruments_id', 'revisions_id', 'contributors_id', 'firstname', 'lastname' ];
}
