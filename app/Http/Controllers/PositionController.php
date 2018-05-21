<?php

namespace App\Http\Controllers;
use App\Device;
use App\Position;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        try {
            $devices = Device::where('user_id',auth()->user()->id)->firstOrFail()->get();
          } catch (ModelNotFoundException $ex) {
            return view('pages.tracking')->with('devices', NULL);
          }
          return view('pages.tracking')->with('devices', $devices);


    }

    public function getpositions(Request $name)
    {
        $mydevices = Device::where('user_id',auth()->user()->id)->get();
        try {
            $devices = Device::where('user_id', '=', auth()->user()->id)
                             ->where('name', '=', $name->name)->get();
            $positions = Position::where('device_id',$devices->first()->id)->get();
        }   catch (ModelNotFoundException $ex) {
            return "No locations found!";
        }
        return $positions;
       //return view('pages.tracking')->with('devices', $mydevices)->with('positions', $positions);
    }

}
