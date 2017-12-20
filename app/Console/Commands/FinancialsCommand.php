<?php

namespace App\Console\Commands;

use App\Financials;
use DB;
use Goutte\Client;
use Illuminate\Console\Command;

class FinancialsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Financials:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download financias, such as market cap, volume etc.';

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
        $client = new Client();
        $cssSelector = 'tr';
        $coin = 'td.no-wrap.currency-name > a';
        $market_cap = 'td.no-wrap.market-cap.text-right';
        $volume_24h = 'td:nth-child(7) > a';
        $circulatingSupply = 'td.no-wrap.text-right.circulating-supply > a';

        //arrays
        $coinArr = array();
        $market_capArr = array();
        $volume_24hArr = array();
        $circulatingSupplyArr = array();

        $crawler = $client->request('GET', 'https://coinmarketcap.com/all/views/all/');
        $crawler->filter($coin)->each(function ($node) use (&$coinArr) {
            array_push($coinArr, $node->text());
        });
        $crawler->filter($market_cap)->each(function ($node) use (&$market_capArr) {
            $p = $node->extract(array('data-usd'));
            array_push($market_capArr, floatval($p[0]));
        });
        $crawler->filter($volume_24h)->each(function ($node) use (&$volume_24hArr) {
            $d = $node->extract(array('data-usd'));
            array_push($volume_24hArr, floatval($d[0]));
        });
        $crawler->filter($circulatingSupply)->each(function ($node) use (&$circulatingSupplyArr) {
            $i = $node->extract(array('data-supply'));
            array_push($circulatingSupplyArr, floatval($i[0]));
        });

        // Multi Dimensional Array
        foreach ($coinArr as $key => $v) {
            //for ($key = 0; $key < 100; $key++) {
            
            /*if (!empty($market_capArr[$key])) {
                $market_capArr[$key] = 0;
            }
            if (!empty($volume_24hArr[$key])) {
                $volume_24hArr[$key] = 0;
            }*/
            if (!isset($circulatingSupplyArr[$key])) {
                $circulatingSupplyArr[$key] = 0;
            }
            print_r("####################" . "\n");
            print_r("Coin: " . $coinArr[$key] . "\n");
            print_r("Market Cap: " . floatval($market_capArr[$key]). "\n");
            print_r("Volume 24h: " . floatval($volume_24hArr[$key]). "\n");
            print_r("Circulating Supply: " . $circulatingSupplyArr[$key]. "\n");
            
            // $instruments_id = Instruments::where('name', '=', $coinArr[$key]);
            $instruments_id = DB::table('instruments')->where('name', $coinArr[$key])->first();
            if (!empty($instruments_id)) {
                try {
                    Financials::updateOrCreate(
                        ['instruments_id' => $instruments_id->id,
                            'market_cap' => $market_capArr[$key],
                            'volume_24h' => $volume_24hArr[$key],
                            'circulatingSupply' => $circulatingSupplyArr[$key]]
                    );
                } catch (Exception $e) {
                }
            }
        }
    }
}
