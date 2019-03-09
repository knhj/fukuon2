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

    //表示処理関数
    public function index() {
        // $voices = Voice::where('user_id',Auth::user()->id)
        //             ->orderBy('deadline', 'desc')
        //             ->get();
        
        $voices = Voice::orderBy('created_at', 'desc')
            ->get();
            
       return $voices;
    }


    //削除処理関数

   public function destroy($task_id) {
       $task = Task::where('user_id',Auth::user()->id)->find($task_id);
       $task->delete();
       $tasks = Task::where('user_id',Auth::user()->id)
               ->orderBy('deadline', 'desc')
               ->get();
       return $tasks;
   }

    
    
    
    
    
}
