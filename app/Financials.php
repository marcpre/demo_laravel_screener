<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Financials extends Model
{
    protected $fillable = ['instruments_id', 'market_cap', 'volume_24h', 'circulatingSupply'];
}
