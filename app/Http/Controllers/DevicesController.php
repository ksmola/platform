<?php

namespace App\Http\Controllers;
use App\Device;
use App\User;
use App\Position;
use Illuminate\Http\Request;

class DevicesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->is_admin) {
            $devices = Device::orderBy('id', 'asc')->paginate(5);           
            return view('devices.index')->with('devices', $devices);
        }
        $devices = Device::where('user_id', auth()->user()->id)->orderBy('id', 'asc')->paginate(5);
        return view('devices.index')->with('devices', $devices);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('devices.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'device_id' => 'required',

        ]);

        //add into database
        $device = new Device;
        $device->id = $request->input('device_id');
        $device->imei = $request->input('imei');
        $device->save();

        return redirect('/devices')->with('success', 'Device Added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $devices = Device::find($id);            
        $positions = Position::where('device_id',$devices->id)->latest()->firstOrFail();
        // $positions = Position::where('device_id',$devices->id)->get();

        // $positions = Position::latest()->first();
        return view('devices.show')->with('device', $devices)->with('position', $positions);
;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $device = Device::find($id);
        return view('devices.edit')->with('device', $device);
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
        $this->validate($request, [
            'device_id' => 'required',

        ]);

        //add into database
        $device = Device::find($id);
        $device->device_id = $request->input('device_id');
        $device->imei = $request->input('imei');
        $device->save();

        return redirect('/devices')->with('success', 'Device Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find($id);
        $device->delete();
        return redirect('/devices')->with('success', 'Device Removed!');
    }
}
