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
            // $table->increments('id');
            $table->primary('device_id')->unique();  //hardware dependent ID
            $table->foreign('user_id')->references('user_id')->on('users');    //FK!
            $table->string('imei')->unique();         //IMEI
            $table->integer('iccid')->unique();        //ICCID
            $table->integer('link_id')->unique();       //hologram link id
            $table->decimal('lat', 10, 7);  //last longitudinal GPS 
            $table->decimal('lng', 10, 7);  //last latitudinal GPS position  
            $table->string('token');        //current active token
            $table->string('new_token');  //newly received but not yet active token
            $table->dateTime('token_updated');         //token renewed
            $table->dateTime('last_token_received');   //time of new token received
            $table->dateTime('responded');             //device received new token
            $table->dateTime('token_created');         //token created
            $table->ipAddress('last_request');         //last communication with device
            $table->json('status');                    //general status info, battery%/charging, alarm status,
            $table->dateTime('last_request_received'); //last new-token request
            $table->boolean('alarm');                  //alarm on/off
            $table->string('name');                    //user defined device name
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
