<?php

namespace App\Console\Commands;

use App\Price;
use ccxt\ccxt;
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
        try {
            $poloniex = new \ccxt\poloniex();
            $this->updatePrices($poloniex, "poloniex");

            $bittrex = new \ccxt\bittrex(array('verbose' => true));
            $this->updatePrices($bittrex, "bittrex");

            $gdax = new \ccxt\gdax();
            $this->updatePrices($gdax, "gdax");

            $bitfinex = new \ccxt\bitfinex();
            $this->updatePrices($bitfinex, "bitfinex");

            $bithumb = new \ccxt\bithumb();
            $this->updatePrices($bithumb, "bithumb");

            $binance = new \ccxt\binance();
            $this->updatePrices($binance, "binance");

            $okex = new \ccxt\okex();
            $this->updatePrices($okex, "okex");

            $hitbtc = new \ccxt\hitbtc();
            $this->updatePrices($hitbtc, "okex");

            $bitstamp = new \ccxt\bitstamp();
            $this->updatePrices($bitstamp, "bitstamp");

            $huobi = new \ccxt\huobi();
            $this->updatePrices($huobi, "huobi");

            $kraken = new \ccxt\kraken();
            $this->updatePrices($kraken, "kraken");

            $btcchina = new \ccxt\btcchina();
            $this->updatePrices($btcchina, "btcchina");

            $bitFlyer = new \ccxt\bitFlyer();
            $this->updatePrices($bitFlyer, "bitFlyer");

            $gemini = new \ccxt\gemini();
            $this->updatePrices($gemini, "gemini");

            $cex = new \ccxt\cex();
            $this->updatePrices($cex, "cex");

            $wex = new \ccxt\wex();
            $this->updatePrices($wex, "wex");

            $yobit = new \ccxt\yobit();
            $this->updatePrices($yobit, "yobit");

            $btcx = new \ccxt\btcx();
            $this->updatePrices($btcx, "btcx");
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
    public function updatePrices($exchangeObj, $exchangeName)
    {
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
            $tick = $exchangeObj->fetch_ticker($symbolsArray[$key]->symbol);
            // exchange time conversion
            $exch_datetime = date("Y-m-d g:i:s", strtotime($tick['datetime']));

            try {
                print_r("#######################" . "\n");
                print_r($exchangeName . ": " . $symbolsArray[$key]->symbol . "\n");
                //print_r($symbolsArray[$key]->exchanges_id . "\n");
                //print_r($exch_datetime . "\n");
                // print_r($tick['ask'] . "\n");

                $price = Price::updateOrCreate([
                    'exchanges_id' => $symbolsArray[$key]->exchanges_id,
                    'exch_datetime' => $exch_datetime,
                ], [
                    'ask' => $tick['ask'],
                    'exchanges_id' => $symbolsArray[$key]->exchanges_id,
                    'exch_datetime' => $exch_datetime,
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
                ]);
            } catch (\Exception $e) {
                Log::info($e->getMessage());
            }
        }
    }
}
