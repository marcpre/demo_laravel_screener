<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Financials;
use Goutte\Client;

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
            //    print $node->text()."\n";
            array_push($coinArr, $node->text());
        });
        $crawler->filter($market_cap)->each(function ($node) use (&$market_capArr) {
            //    print $node->text()."\n";
            $p = $node->extract(array('data-usd'));
            array_push($market_capArr, $p[0]);
        });
        $crawler->filter($volume_24h)->each(function ($node) use (&$volume_24hArr) {
            //    print $node->text()."\n";
            $d = $node->extract(array('data-usd'));
            array_push($volume_24hArr, $d[0]);
        });
        $crawler->filter($circulatingSupply)->each(function ($node) use (&$circulatingSupplyArr) {
        //    $w = $node->extract(array('data-supply'));
        //    array_push($circulatingSupply, $w[0]);
            array_push($circulatingSupplyArr, $node->text());
        });        

        // Multi Dimensional Array
        // foreach ($coinArr as $key => $v) {
        for ($key = 0; $key < 100; $key++) {
            print_r($market_capArr[$key]);
            print_r($volume_24hArr[$key]);
            print_r($circulatingSupplyArr[$key]);
            try {
                Financials::updateOrCreate(
                    ['market_cap' => $market_capArr[$key],
                    'volume_24h' => $volume_24hArr[$key],
                    'circulatingSupply' => $circulatingSupplyArr[$key]]
                );
            } catch (Exception $e) { 
            }
        }
    }
}
