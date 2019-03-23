<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Voice;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {
        return view('home');
    }
    
    //トップ画面表示
    public function top()
    {
        //apiを使用するときはmain.blade.phpへ飛ばす
        // return view('main');
        return view('top');
    }
    
    //動画検索画面表示
    public  function video_search() {
        // $item  =  DB::table('voices')->get();
        // return view('video_search')->with(["item" => $item]);
        return view('video_search');
    }
    
    //副音声検索画面表示
      public  function fukuon_search() {
        // $item  =  Voice::get();
         $items  =  Voice::simplePaginate(5);
        return view('fukuon_search')->with(["items" => $items]);
        // return view('fukuon_search');
    }
    
     //副音声検索
      public  function fukuon_keyword_search($keyword) {
        $items  = Voice::where('fukuon_title','like','%'.$keyword.'%')->simplePaginate(5);
        return view('fukuon_search')->with(["items" => $items]);
    }
    
    
    
     public function play($video_id,$fukuon_id) {
        $item  =  DB::table('voices')->where("fukuon_id",$fukuon_id)->get();
        return view('play')->with(["item" => $item]);
    }
    
    //副音声の投稿画面へ
     function store($video_id) {
        $item  =  DB::table('voices')->where("video_id",$video_id)->get();
         return view('store')->with(["video_id" =>$video_id,"item" => $item]);
    }
    
    
    //副音声の再生回数を増やす
       function add($fukuon_id) {
        DB::table('voices')->where("fukuon_id",$fukuon_id)->increment('play_count');
    }
    
      //ランキングを表示
      function ranking() {
        // $item  =  DB::table('voices')->orderBy('play_count', 'desc')->limit(20)->get();
        $ranking = Voice::orderBy('play_count','desc')
                   ->limit(20)
                   ->get();
                   
        return view('ranking')->with(["item" => $ranking]);
    }
    
      //新着副音声を表示
    function newlist(){
        
         $newlist = Voice::orderBy('created_at', 'desc')
                    ->limit(20)
                    ->get();
        return view('newlist')->with(["item" => $newlist]);
    }
    
    //動画に対して何件の副音声が投稿されているかその件数を返す関数
      function number($video_id) {
        // $item  =  DB::table('voices')->where("video_id",$video_id)->count();
         $video_count = Voice::where('video_id',$video_id)
            ->count();
        return $video_count;
    }
    
    
    
    
    
    
    
    
    
    
    
    //副音声の投稿（音声データの投稿）
    function access(Request $request){
    if(
    // !isset($_POST['name']) || $_POST['name']=="" ||
    !isset($_FILES['data']) || $_FILES['data']=="" ||
    !isset($_POST['wavname']) || $_POST['wavname']=="" ||
    !isset($_POST['mp3name']) || $_POST['mp3name']==""
    
    ){
    exit('ParamError');
    }
   
  
    $tmp_path  = $_FILES['data']['tmp_name']; //アップロード先のTempフォルダ
    $file_dir_path = 'upload/';                 //画像ファイル保管先のディレクトリ名，自分で設定する
   
    $file_name = $file_dir_path.$_POST['wavname'];  
    $mp3_file_name = $file_dir_path.$_POST['mp3name']; 

    $mp3name = $_POST['mp3name'];
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $ftitle = $_POST['ftitle'];
    $vid = $_POST['vid'];
    $comment = $_POST['comment'];
    
    $auth_id = Auth::user()->id;

   
   DB::table('voices')->insert(
    ['name' => $username, 'user_id' => $auth_id,'video_id' => $vid, 'fukuon_id' => $fname,'fukuon_title' => $ftitle,'fukuon_comment' => $comment,'created_at' => Carbon::now(),'updated_at' => Carbon::now()]
   );

    if ( is_uploaded_file( $tmp_path ) ) {
        if ( move_uploaded_file( $tmp_path, $file_name ) ) {
            chmod( $file_name, 0644 );
            
            // shell_exec("ffmpeg -i ".$file_name." -vn -ac 2 -ar 44100 -ab 256k -acodec libmp3lame -f mp3 ".$mp3_file_name);
            // shell_exec("rm ".$file_name);
            exit('アップロードが完了しました！');
            return redirect('/part/'.$vid);
            
        } else {
            exit('Error:アップロードできませんでした．');
        }
    }
        
  }
    
    
    
}
