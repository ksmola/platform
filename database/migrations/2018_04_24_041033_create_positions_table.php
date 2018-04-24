<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');	
            $table->integer('device_id');
            $table->foreign('device_id')->references('id')->on('devices'); 
            $table->decimal('lat', 10, 7);  //last longitudinal GPS 
            $table->decimal('lng', 10, 7);  //last latitudinal GPS position  
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
        Schema::dropIfExists('positions');
    }
}
