<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Voice;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class HomeController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
        
        //ユーザー情報の取得は、use Auth　して以下のようにして取得する
        //id
        // $auth = Auth::user()->id;
        //               [id, task, ...]
        // $auths = Auth::user();
        
        
    }
    
    public function top()
    {
        return view('main');
    }
    
     function play($video_id,$fukuon_id) {
        $item  =  DB::table('voices')->where("fukuon_id",$fukuon_id)->get();
        return view('play')->with(["item" => $item]);
    }
    
     function store($video_id) {
       
        $item  =  DB::table('voices')->where("video_id",$video_id)->get();
         return view('store')->with(["item" => $item]);
    }
    
    
    
}
