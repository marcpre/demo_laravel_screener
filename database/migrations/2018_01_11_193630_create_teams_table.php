<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('instruments_id')->nullable($value = true);
            $table->integer('users_id')->nullable($value = true);
            $table->integer('revisions_id')->nullable($value = true);
            $table->string('firstname')->nullable($value = true);
            $table->string('lastname')->nullable($value = true);
            $table->string('twitterAccount')->nullable($value = true);
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
        Schema::dropIfExists('teams');
    }
}
