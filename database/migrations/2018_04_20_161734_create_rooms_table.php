<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('number');
            $table->integer('capacity');
          
            $table->unsignedInteger('created_by');///foriegn key to the manager table 
            $table->foreign('created_by')->nullable()
            ->references('id')->on('users')
            ->onDelete('cascade');

            $table->unsignedInteger('floor_id');///foriegn key to the floorstable 
            $table->foreign('floor_id')->nullable()
            ->references('id')->on('floors')
            ->onDelete('cascade');
            $table->integer('status');
            $table->string('price');
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
        Schema::dropIfExists('rooms');
    }
}
