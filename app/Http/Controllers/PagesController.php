<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function index(){
        $user = User::where('id', auth()->user()->id)->firstOrFail();
        return view('pages.index')->with('user', $user);
    }

    public function about(){
        // return view('pages.about');
    }

    // public function tracking(){
    //     return view('pages.tracking');
    //     // $data = array(
    //     //     'title' => 'Services', 
    //     //     'services' => ['Web Design', 'Programming', 'etc']
    //     // );
    //     // return view('pages.services')->with($data);
    // }
}
