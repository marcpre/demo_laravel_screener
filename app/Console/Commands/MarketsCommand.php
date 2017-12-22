<?php

namespace App\Console\Commands;

use App\Markets;
use DB;
use Illuminate\Console\Command;
use Log;

class MarketsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Markets:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all available markets';

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
            
            //currently 18ten markets
            $poloniex = new \ccxt\poloniex();
            $poloArray = $poloniex->load_markets();
            $this->updateMarket($poloArray, "poloniex");

            $bittrex = new \ccxt\bittrex(array('verbose' => true));
            $bittrexArray = $bittrex->load_markets();
            $this->updateMarket($bittrexArray, "bittrex");

            $gdax = new \ccxt\gdax();
            $gdaxArray = $gdax->load_markets();
            $this->updateMarket($gdaxArray, "gdax");

            $bitfinex = new \ccxt\bitfinex();
            $bitfinexArray = $bitfinex->load_markets();
            $this->updateMarket($bitfinexArray, "bitfinex");

            $bithumb = new \ccxt\bithumb();
            $bithumbArray = $bithumb->load_markets();
            $this->updateMarket($bithumbArray, "bithumb");

            $binance = new \ccxt\binance();
            $binanceArray = $binance->load_markets();
            $this->updateMarket($binanceArray, "binance");

            $okex = new \ccxt\okex();
            $okexArray = $okex->load_markets();
            $this->updateMarket($okexArray, "okex");

            $hitbtc = new \ccxt\hitbtc();
            $hitbtcArray = $hitbtc->load_markets();
            $this->updateMarket($hitbtcArray, "hitbtc");

            $bitstamp = new \ccxt\bitstamp();
            $bitstampArray = $bitstamp->load_markets();
            $this->updateMarket($bitstampArray, "bitstamp");

            $huobi = new \ccxt\huobi();
            $huobiArray = $huobi->load_markets();
            $this->updateMarket($huobiArray, "huobi");

            $kraken = new \ccxt\kraken();
            $krakenArray = $kraken->load_markets();
            $this->updateMarket($krakenArray, "kraken");

            $btcchina = new \ccxt\btcchina();
            $btcchinaArray = $btcchina->load_markets();
            $this->updateMarket($btcchinaArray, "btcchina");
                        
            $bitFlyer = new \ccxt\bitFlyer();
            $bitFlyerArray = $bitFlyer->load_markets();
            $this->updateMarket($bitFlyerArray, "bitFlyer");
            
            $gemini = new \ccxt\gemini();
            $geminiArray = $gemini->load_markets();
            $this->updateMarket($geminiArray, "gemini");            

            $cex = new \ccxt\cex();
            $cexArray = $cex->load_markets();
            $this->updateMarket($cexArray, "cex");    

            $wex = new \ccxt\wex();
            $wexArray = $wex->load_markets();
            $this->updateMarket($wexArray, "wex");    
            
            $yobit = new \ccxt\yobit();
            $yobitArray = $yobit->load_markets();
            $this->updateMarket($yobitArray, "yobit");    

            $btcx = new \ccxt\btcx();
            $btcxArray = $btcx->load_markets();
            $this->updateMarket($btcxArray, "btcx");    
            
            // print_r($poloArray);
            //insert poloniex markets into db
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function updateMarket($marketsArray, $exchangeName)
    {
        foreach ($marketsArray as $key => $v) {
            // for ($key = 0; $key < 1000; $key++) {
            $exchanges_id = DB::table('exchanges')->where('name', $exchangeName)->first();
            print_r($exchangeName . ": " . $marketsArray[$key]['symbol'] . "\n");
/*            print_r($marketsArray[$key]['base'] . "\n");
print_r($marketsArray[$key]['quote'] . "\n");
print_r($exchanges_id);
 */
            try {
                Markets::updateOrCreate([
                    'exchanges_id' => $exchanges_id->id,
                    'instruments_id' => $instruments_id->id,
                    'symbol' => $marketsArray[$key]['symbol'],
                ], [
                    'exchanges_id' => $exchanges_id->id,
                    'symbol' => $marketsArray[$key]['symbol'],
                    'base' => $marketsArray[$key]['base'],
                    'quote' => $marketsArray[$key]['quote'],
                ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
