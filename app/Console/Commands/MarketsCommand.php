<?php

namespace App\Console\Commands;

use DB;
use App\Markets;
use Log;
use Illuminate\Console\Command;

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
        $poloniex = new \ccxt\poloniex();
        $poloArray = $poloniex->load_markets();
        $this->updateMarket($poloArray, "poloniex");

        // print_r($poloArray);
        //insert poloniex markets into db

    }

    public function updateMarket($marketsArray, $exchangeName)
    {
        foreach ($marketsArray as $key => $v) {
            // for ($key = 0; $key < 1000; $key++) {
            $exchanges_id = DB::table('exchanges')->where('name', $exchangeName)->first();
            var_dump($marketsArray[$key]['symbol']);

            try {
                ///save image to public folder
                Markets::updateOrCreate([
                    'symbol' => $marketsArray[$key]->symbol,
                ], [
                    'exchanges_id' => $exchanges_id,
                    'symbol' => $marketsArray[$key]->symbol,
                    'base' => $marketsArray[$key]->base,
                    'quote' => $marketsArray[$key]->quote,
                ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
