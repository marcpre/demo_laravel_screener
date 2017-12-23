<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        $symbolsArray = DB::table('instruments')
        ->join('markets', 'instruments.id', '=', 'markets.instruments_id')
        ->join('financials', 'instruments.id', '=', 'financials.instruments_id')
        ->join('markets', 'instruments.id', '=', 'markets.instruments_id')

        ->where('name', $exchangeName)
        ->get(array(
            'symbol',
            'image',
            'market_cap',
            'current_price',
            '%Change',
            'volume',
        ))->toArray();
    }
}
