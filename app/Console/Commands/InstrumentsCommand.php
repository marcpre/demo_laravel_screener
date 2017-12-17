<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use App\Instruments;

class InstrumentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Instruments:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get basic information for instrument.';

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
        $url = 'td.no-wrap.currency-name > a';
        $symbol = 'td.text-left.col-symbol';
        $img = 'body > div.container > div > div.col-lg-10 > div:nth-child(5) > div.col-xs-6.col-sm-4.col-md-4 > h1 > img';
        //arrays
        $coinArr = array();
        $urlArr = array();
        $symbolArr = array();
        $imgArr = array();
        $crawler = $client->request('GET', 'https://coinmarketcap.com/all/views/all/');
        $crawler->filter($coin)->each(function ($node) use (&$coinArr) {
            //    print $node->text()."\n";
            array_push($coinArr, $node->text());
        });
        $crawler->filter($url)->each(function ($node) use (&$urlArr) {
            $link = $node->link();
            $uri = $link->getUri();
            //    print $uri."\n";
            array_push($urlArr, $uri);
        });
        $crawler->filter($symbol)->each(function ($node) use (&$symbolArr) {
            //    print $node->text()."\n";
            array_push($symbolArr, $node->text());
        });
        // get Links from Subpages
        foreach ($urlArr as $key => $v) {
            // for ($key = 0; $key < 100; $key++) {
            try {
                $subCrawler = $client->request('GET', $urlArr[$key]);
                $image = $subCrawler->filter($img)->extract(array('src'));
                $image[0] = isset($image[0]) ? $image[0] : ''; // No Error such as "Undefined offset: 0"
                print_r($image[0] . "\n");
                array_push($imgArr, $image[0]);
            } catch (Exception $e) {

            }
        }
        print_r($imgArr);

        //Multi Dimensional Array
        foreach ($coinArr as $key => $v) {
            try {
                ///save image to public folder
                $fileName = basename($imgArr[$key]);
                print_r($fileName . "\n");
                Image::make($imgArr[$key])->save(public_path('images/' . $fileName));

                Instruments::updateOrCreate([
                    'name' => $coinArr[$key],
                ], [
                    'name' => $coinArr[$key],
                    'symbol' => $symbolArr[$key],
                    'image' => $fileName,
                ]);
            } catch (Exception $e) {
            }
        }
    }
}
