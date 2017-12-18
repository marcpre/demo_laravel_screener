<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Financials extends Model
{
    protected $fillable = ['market_cap', 'volume', 'daily_percent_change'];
}
