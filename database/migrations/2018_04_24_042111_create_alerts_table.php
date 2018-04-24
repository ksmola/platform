<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->increments('id');
            $table->foreign('device_id')->references('id')->on('devices'); 
            $table->timestamp('time'); //time of position, not time when db got updated
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
        Schema::dropIfExists('alerts');
    }
}
