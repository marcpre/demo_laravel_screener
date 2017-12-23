<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use Log;

class OverviewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Overview:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the Overview Table.';

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
/* SQL Query:
$overviewArray = DB::raw('SELECT *
FROM instruments
LEFT join financials on instruments.id=financials.instruments_id
WHERE financials.id IN
( SELECT MAX(financials.id)
FROM financials
GROUP BY financials.instruments_id )
ORDER BY instruments.id ASC');
 */
        $overviewArray = DB::table('instruments')
            ->leftJoin('financials', 'instruments.id', '=', 'financials.instruments_id')
            ->whereIn('financials.id', DB::raw('SELECT MAX(financials.id)
    FROM financials
    GROUP BY financials.instruments_id '))
            ->orderBy('instruments.id')
            ->get()
            ->toArray();
            
/*
$overviewArray = DB::table('instruments')
->leftJoin('financials', 'instruments.id', '=', 'financials.instruments_id')
->whereIn('financials.id', DB::raw('SELECT MAX(financials.id)
FROM financials
GROUP BY financials.instruments_id )
ORDER BY instruments.id ASC'))->get()->toArray();

$overviewArray = (array) $result;
 */
        print_r($overviewArray);

        foreach ($overviewArray as $key => $v) {
            try {

                $overview = Overview::updateOrCreate([
                    'symbol' => $overviewArray[$key]['symbol'],
                ], [
                    'symbol' => $overviewArray[$key]['symbol'],
                    'instruments_id' => $instrument->id['instruments_id'],
                    'financials_id' => $overviewArray[$key]['financials_id'],
                    'name' => $overviewArray[$key]['name'],
                    'symbol' => $overviewArray[$key]['symbol'],
                    'image' => $overviewArray[$key]['image'],
                    'sector' => $overviewArray[$key]['sector'],
                    'country_of_origin' => $overviewArray[$key]['country_of_origin'],
                    'market_cap' => $overviewArray[$key]['market_cap'],
                    'volume_24h' => $overviewArray[$key]['volume_24h'],
                    'circulatingSupply' => $overviewArray[$key]['circulatingSupply'],
                ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
