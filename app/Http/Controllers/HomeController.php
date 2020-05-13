<?php

namespace App\Http\Controllers;

use App\SocketApp;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $apps = SocketApp::where('user_id', auth()->id())->get();
        return view('home', ['socket_apps'=> $apps]);
    }
}
