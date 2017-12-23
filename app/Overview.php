<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    protected $fillable = ['exchanges_id', 'instruments_id', 'financials_id', 'name', 'symbol', 'image', 'sector', 'country_of_origin', 'market_cap', 'volume_24h', 'circulatingSupply'];
}
