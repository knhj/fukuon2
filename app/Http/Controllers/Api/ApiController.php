<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Voice;
use Validator;
use Auth;
use App\Http\Controllers\Controller;


class ApiController extends Controller
{
    
     public function __construct(){
        $this->middleware('auth');
    }
    //登録処理関数
    public function store(Request $request) {

       $voice = new Voice;
       $voice->user_id = Auth::user()->id;
       $voice->task = $request->task;
       $voice->deadline = $request->deadline;
       $voice->comment = $request->comment;
       $voice->save();
       $voices = Voice::where('user_id',Auth::user()->id)
                   ->orderBy('deadline', 'desc')
                   ->get();
       return $voices;
    }

    //表示処理関数1
    public function newlist() {
        // $voices = Voice::where('user_id',Auth::user()->id)
        //             ->orderBy('deadline', 'desc')
        //             ->get();
        
        $voices = Voice::orderBy('created_at', 'desc')
            ->get();
            
        return $voices;
    }

    public function ranking() {
        $voices = Voice::orderBy('play_count', 'desc')
            ->get();
            
        return $voices;
    }

    public function mypage() {
        
        $voices = Voice::where('user_id',Auth::user()->id)
        ->orderBy('created_at', 'desc')
            ->get();
            
        return $voices;
    }

    // 削除処理関数
     public function destroy($voice_id) {
      $voice = Voice::where('user_id',Auth::user()->id)
             ->find($voice_id);
      $voice->delete();
      $voices = Voice::where('user_id',Auth::user()->id)
              ->orderBy('deadline', 'desc')
              ->get();
      return $voices;
  }

    //動画に対する副音声投稿数カウント
     public function cast_count($video_id) {
       $voices = Voice::where('video_id',$video_id)
            ->count();
            
        return $voices;
    }
    
     public function play_count_add($fukuon_id) {
        // DB::table('voices')->where("f_id",$fid)->increment('play_count');
         Voice::where('fukuon_id',$fukuon_id)->increment('play_count');
    }
    
}
