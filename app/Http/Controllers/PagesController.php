<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PagesController extends Controller
{
    public function index(){
        $title = 'Good day!';
        $user = User::where('id', auth()->user()->id)->first();
        return view('pages.index', compact('title'))->with('user', $user);
    }

    public function about(){
        // return view('pages.about');
    }

    public function services(){
        // $data = array(
        //     'title' => 'Services', 
        //     'services' => ['Web Design', 'Programming', 'etc']
        // );
        // return view('pages.services')->with($data);
    }
}
