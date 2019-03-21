<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// ログイン中のみ処理を実行する
Route::group(['middleware' => ['auth']], function () {
   // api関連の処理をまとめる（urlに自動的に/apiが加わる）
  Route::group(['middleware' => ['api']], function(){
      // 表示新着順
      Route::get('/', 'Api\ApiController@newlist');
       // 表示再生回数が多い順
      Route::get('/ranking', 'Api\ApiController@ranking');
      // 登録
    //   Route::post('/tasks', 'Api\ApiController@store');
      Route::get('/mypage', 'Api\ApiController@mypage');
    
    
      // 削除
      Route::get('/delete/{voice_id}', 'Api\ApiController@destroy');
    
    // 動画検索時のその動画の投稿済副音声数を返す
     Route::get('/number/{video_id}', 'Api\ApiController@cast_count');
    
     Route::get('/play_count_add/{fukuon_id}', 'Api\ApiController@play_count_add');

    // Route::get('/part/{vid}/{fid}', 'Api\ApiController@play');
    
    
  });
});
