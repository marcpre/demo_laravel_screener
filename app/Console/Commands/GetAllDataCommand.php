<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetAllDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getall:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup db and get all data.';

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
        $this->call('migrate:fresh', ['--seed' => 'default']);
        $this->call('Instruments:download');
        $this->call('Financials:download');
        $this->call('Exchanges:download');
        $this->call('Markets:download');
    }
}


