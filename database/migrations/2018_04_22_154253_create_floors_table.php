<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
           
     
        Schema::create('floors', function (Blueprint $table) {

        // $table->increments('id');

        $table->string('name');
        $table->bigIncrements('floor_num')->unsigned();
        $table->integer('manager_id')->nullable();
        $table->timestamps();
        });
        DB::update("ALTER TABLE floors AUTO_INCREMENT = 1000;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('floors');
    }
}
