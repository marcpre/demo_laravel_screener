<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = ['instruments_id', 'revisions_id', 'contributors_id', 'link', 'type' ];

}
