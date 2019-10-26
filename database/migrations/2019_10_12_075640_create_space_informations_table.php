<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpaceInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('space_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('owner_id');
            $table->integer('car');
            $table->integer('bike');
            $table->integer('usedcar');
            $table->integer('usedbike');
            $table->integer('freecar');
            $table->integer('freebike');
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
        Schema::dropIfExists('space_informations');
    }
}
