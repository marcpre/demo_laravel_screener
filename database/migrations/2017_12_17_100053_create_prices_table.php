<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exchanges_id');
            $table->string('symbol');
            $table->dateTime('exch_datetime');
            $table->decimal('high', 40, 9);
            $table->decimal('low', 40, 9);
            $table->decimal('bid', 40, 9);
            $table->decimal('ask', 40, 9);
            $table->decimal('vwap', 40, 9);
            $table->decimal('open', 40, 9);
            $table->decimal('first', 40, 9);
            $table->decimal('last', 40, 9);
            $table->decimal('change', 40, 9);
            $table->decimal('average', 40, 9);
            $table->decimal('baseVolume', 40, 9);
            $table->decimal('quoteVolume', 40, 9);
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
        Schema::dropIfExists('prices');
    }
}
