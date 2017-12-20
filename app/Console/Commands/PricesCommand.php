<?php

namespace App\Console\Commands;

use ccxt\ccxt;
use Illuminate\Console\Command;

class PricesCommand extends Command
{
/**
 * The name and signature of the console command.
 *
 * @var string
 */
    protected $signature = 'Prices:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get prices for the 10 world largest exchanges.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $poloniex = new \ccxt\poloniex();
        $bittrex = new \ccxt\bittrex(array('verbose' => true));
        $bitfinex;
        $bithumb;
        $binance;
        $gdax = new \ccxt\gdax();
        $okex;
        $hitbtc;
        $bitstamp;
        $huobi;
        $kraken;

        print_r($poloniex->load_markets());
        print_r("#################" . "\n");
        print_r($poloniex->fetch_ticker('STORJ/BTC'));

        // var_dump($poloniex->fetch_order_book($poloniex->symbols[0]));

/*
foreach ($exchArr as $key => $v) {
print_r($exchArr[$key] . "\n");
try {
Exchanges::updateOrCreate(
['name' => $exchArr[$key]]
);
} catch (Exception $e) {
}
}
 */
    }
}
