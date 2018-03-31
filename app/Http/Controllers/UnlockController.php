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
        // $request->hasHeader('key');
        //$request->accepts($contentTypes)
        // return $request->header();
        // return $request;
        //return $request->device_id;
        
        $this->validate($request, [
            'device_id' => 'required', 
        ]);


        $device = Device::where('device_id', $request->device_id)->first();
        $device->new_token = (bin2hex(random_bytes(16)));
        $device->token_created = now()->toDateTimeString();
        $device->last_request = $request->ip();
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
