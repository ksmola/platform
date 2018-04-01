<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Device;

class UnlockController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function unlock(Request $request) {
        
        $this->validate($request, [
            'device_id' => 'required', 
        ]);

        $device = Device::where('device_id', $request->device_id)->first();
        $device->token_created = now()->toDateTimeString();
        $device->last_request = $request->ip();

        $device->new_token = (bin2hex(random_bytes(16)));
        $device->save();
        return $device;
    }

    public function token_received(Request $request) {

        $this->validate($request, [
            'device_id' => 'required', 
        ]);

        $device = Device::where('device_id', $request->device_id)->first();
        $device->last_request_received = now()->toDateTimeString();
        $device->last_request = $request->ip();
        $device->responded = now()->toDateTimeString();
        if ($device->token !== $device->new_token) {
            $device->token = $device->new_token;
            $device->token_updated = now()->toDateTimeString();
        }
        $device->save();
        return $device;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 'working';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
