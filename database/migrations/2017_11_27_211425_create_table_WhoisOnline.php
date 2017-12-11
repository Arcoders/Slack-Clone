<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWhoisOnline extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Online', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('room_id')->nullable();
            $table->integer('private_id')->nullable();
            $table->string('timelogin');
            $table->string('timelogout')->nullable();
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
        Schema::dropIfExists('Online');
    }
}
