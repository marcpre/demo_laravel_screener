<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = ['exchanges_id', 'symbol', 'exch_datetime', 'high', 'low', 'bid' , 'ask',  'vwap', 'open', 'first', 'last', 'change', 'average', 'baseVolume', 'quoteVolume',];
}
