<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financials', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instruments_id');
            $table->decimal('market_cap', 40, 9);
            $table->decimal('volume_24h', 40, 9);
            $table->decimal('circulatingSupply', 40, 4);
//            $table->decimal('daily_percent_change', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financials');
    }
}
