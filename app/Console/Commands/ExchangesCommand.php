<?php

namespace App\Console\Commands;

use App\Exchanges;
use ccxt\ccxt;
use Illuminate\Console\Command;

class ExchangesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Exchanges:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download available exchanges from cctx library';

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
        $exchArr = \ccxt\Exchange::$exchanges;

        foreach ($exchArr as $key => $v) {
            print_r($exchArr[$key] . "\n");
            try {
                Exchanges::updateOrCreate(
                    ['name' => $exchArr[$key]]
                );
            } catch (Exception $e) {
            }
        }
    }
}
