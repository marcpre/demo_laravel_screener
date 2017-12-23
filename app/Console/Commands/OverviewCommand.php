<?php

namespace App\Console\Commands;

use App\Overview;
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
        $result = DB::table('instruments')
            ->leftJoin('financials', 'instruments.id', '=', 'financials.instruments_id')
            ->whereIn('financials.id', function ($query) {
                $query->select(DB::raw('MAX(financials.id)'))->
                    from('financials')->
                    groupBy('financials.instruments_id');})
            ->orderBy('instruments.id')
            ->get()
            ->toArray();
        $overviewArray = (array) $result;
        
        // print_r($overviewArray[1]);
        // print_r($overviewArray[1]->name . "\n");

        foreach ($overviewArray as $key => $v) {
            print_r($key . " - " . $overviewArray[$key]->symbol . "\n");
            
            try {
                $overview = Overview::updateOrCreate([
                    'symbol' => $overviewArray[$key]->symbol,
                ], [
                    'instruments_id' => $overviewArray[$key]->instruments_id,
                    // 'financials_id' => $overviewArray[$key]->financials_id,
                    'name' => $overviewArray[$key]->name,
                    'symbol' => $overviewArray[$key]->symbol,
                    'image' => $overviewArray[$key]->image,
                    'market_cap' => $overviewArray[$key]->market_cap,
                    'volume_24h' => $overviewArray[$key]->volume_24h,
                    'circulatingSupply' => $overviewArray[$key]->circulatingSupply,
                ]);
            } catch (\Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
