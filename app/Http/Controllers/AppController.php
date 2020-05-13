<?php

namespace App\Http\Controllers;

use App\SocketApp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppController extends Controller
{
    public function createApp(Request $request){
        $this->validate($request, [
            'name' => "required",
        ]);

        $name = $request->name;
        $key = md5(md5($request->name).md5(time()));
        $secret = md5(md5($key). md5(time()));

        $new_app = [
            "name"=> $name,
            "key"=> $key,
            "secret"=> $secret,
            "user_id"=> Auth::id()
        ];

        if(SocketApp::create($new_app)){
            return back()->with(["info"=> "Your app has been created"]);
        }

        return back()->with(["error"=> "An error occurred. Please try again later."]);
    }

    public function getApp(Request $request){
        $app = SocketApp::find($request->id);

        return view(); // TODO: return view
    }
    public function getMyApps(){
        $apps = SocketApp::where('user_id', Auth::id())->get();

    }
}
