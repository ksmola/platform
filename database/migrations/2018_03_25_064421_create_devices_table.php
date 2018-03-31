<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('device_id');  //hardware dependent ID
            $table->integer('user_id');
            $table->string('imei');         //IMEI
            $table->decimal('lng', 10, 7);  //last longitudinal GPS 
            $table->decimal('lat', 10, 7);  //last latitudinal GPS position  
            $table->string('token');        //current active token
            $table->string('new_token');  //newly received but not yet active token
            $table->dateTime('last_request_received'); //last new-token request
            $table->dateTime('last_token_received');   //time of new token received
            $table->dateTime('token_created');         //token created
            $table->dateTime('token_updated');         //token renewed
            $table->dateTime('responded');             //device received new token
            $table->ipAddress('last_request');         //last communication with device
            $table->json('status');                    //general status info, battery%/charging, alarm status,
            $table->boolean('alarm');                  //alarm on/off
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
        Schema::dropIfExists('devices');
    }
}
