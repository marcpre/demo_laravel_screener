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
            $table->integer('exchanges_id')->default('999999');
            $table->integer('markets_id')->default('999999');
            $table->string('symbol')->default('DEFAULT_VALUE');
            $table->dateTime('exch_datetime');
            $table->decimal('high', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('low', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('bid', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('ask', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('vwap', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('open', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('first', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('last', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('change', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('average', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('baseVolume', 40, 9)->default('-99999999999999')->nullable($value = true);
            $table->decimal('quoteVolume', 40, 9)->default('-99999999999999')->nullable($value = true);
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
