<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOverviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overview', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('exchanges_id')->default('999999');
            $table->integer('instruments_id');
            $table->integer('financials_id');
            $table->string('name')->nullable($value = true);
            $table->string('symbol')->nullable($value = true);
            $table->string('image')->nullable($value = true);
            $table->string('sector')->nullable($value = true);
            $table->string('country_of_origin')->nullable($value = true);
            $table->decimal('market_cap', 40, 9)->nullable($value = true);
            $table->decimal('volume_24h', 40, 9)->nullable($value = true);
            $table->decimal('circulatingSupply', 40, 4)->nullable($value = true);
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
        Schema::dropIfExists('overview');
    }
}
