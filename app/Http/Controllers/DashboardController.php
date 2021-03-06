<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // if (auth()->user()->is_admin) {
        //     $isadmin = 'yes';
        // }
        // else {
        //     $isadmin = "no";
        // }

        $isadmin = auth()->user()->is_admin;

        return view('dashboard')->with('isadmin', $isadmin);
    }
}
