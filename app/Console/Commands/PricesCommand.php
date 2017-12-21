<?php

namespace App\Console\Commands;

use App\Prices;
use ccxt\ccxt;
use DateTime;
use DB;
use Illuminate\Console\Command;
use Log;

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
        $this->updatePrices($poloniex, "poloniex");

        // print_r($poloniex->fetch_ticker('STORJ/BTC'));

        // var_dump($poloniex->fetch_order_book($poloniex->symbols[0]));

    }
    public function updatePrices($exchangeObj, $exchangeName)
    {
        // $symbolsArray = DB::select(DB::raw("SELECT m.symbol FROM exchanges e, markets m WHERE e.name='" . $exchangeName . "';"));
        $symbolsArray = DB::table('exchanges')
            ->join('markets', 'exchanges.id', '=', 'markets.exchanges_id')
            ->where('name', $exchangeName)
            ->get(array(
                'symbol',
                'name',
                'exchanges_id',
            ))->toArray();
        // print_r($symbolsArray);

        foreach ($symbolsArray as $key => $v) {
            // for ($key = 0; $key < 1000; $key++) {
            print_r($symbolsArray[$key]->symbol . "\n");
            $tick = $exchangeObj->fetch_ticker($symbolsArray[$key]->symbol);
            // var_dump($tick);
/*            var_dump('exchanges_id: ' . $symbolsArray[$key]->exchanges_id . "\n" .
                'exch_datetime: ' . $tick['datetime'] . "\n" .
                'high: ' . $tick['high'] . "\n" .
                'low: ' . $tick['low'] . "\n" .
                'bid: ' . $tick['bid'] . "\n" .
                'ask: ' . $tick['ask'] . "\n" .
                'vwap: ' . $tick['vwap'] . "\n" .
                'open: ' . $tick['open'] . "\n" .
                'first: ' . $tick['first'] . "\n" .
                'last: ' . $tick['last'] . "\n" .
                'change: ' . $tick['change'] . "\n" .
                'average: ' . $tick['average'] . "\n" .
                'baseVolume: ' . $tick['baseVolume'] . "\n" .
                'quoteVolume: ' . $tick['quoteVolume'] . "\n");
*/
            try {
                Prices::listen(function($sql) {
                    var_dump($sql);
                    var_dump($bindings);
                    var_dump($time);
                });
                
                Prices::updateOrCreate([
//                  'exchanges_id' => $symbolsArray[$key]->exchanges_id,
//                    'exch_datetime' => $tick['datetime'],
                ], [
                    'ask' => 99.99,
/*                    'exchanges_id' => $symbolsArray[$key]->exchanges_id,
                    'exch_datetime' => $tick['datetime'],
                    'high' => $tick['high'],
                    'low' => $tick['low'],
                    'bid' => $tick['bid'],
                    'ask' => $tick['ask'],
                    'vwap' => $tick['vwap'],
                    'open' => $tick['open'],
                    'first' => $tick['first'],
                    'last' => $tick['last'],
                    'change' => $tick['change'],
                    'average' => $tick['average'],
                    'baseVolume' => $tick['baseVolume'],
                    'quoteVolume' => $tick['quoteVolume'],
*/                ]);

            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }
        }
    }
}
