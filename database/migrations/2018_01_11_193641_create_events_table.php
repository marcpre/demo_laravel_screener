<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instruments_id')->nullable($value = true);
            $table->integer('revisions_id')->nullable($value = true);
            $table->string('name')->nullable($value = true);
            $table->string('link')->nullable($value = true);
            $table->dateTimeTz('date')->nullable($value = true); //with timezone
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
        Schema::dropIfExists('events');
    }
}
