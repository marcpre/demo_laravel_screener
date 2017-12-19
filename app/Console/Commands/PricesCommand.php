<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PricesCommand extends Command
{
/**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Prices:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get prices for the 10 world largest exchanges.';
    
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
        //
    }
}
