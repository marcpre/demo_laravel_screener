<?php

namespace App\Console\Commands;

use App\Price;
use ccxt\ccxt;
use Illuminate\Console\Command;
use Log;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    }
    public function updatePrices($exchangeObj, $exchangeName)
    {
        $tick = $exchangeObj->fetch_ticker('GAS/BTC');
        var_dump($tick);
        try {
            print_r("#######################" . "\n");
            print_r($tick['datetime'] . "\n");
            print_r($tick['ask'] . "\n");

            $prices = Price::updateOrCreate([
            //    'exchanges_id' => 10,
                'exch_datetime' => $tick['datetime'],
            ], [
                'ask' => $tick['ask'],
            ]);
            var_dump($prices->toSql());

        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
