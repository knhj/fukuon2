<?php


//動画検索画面へ
Route::get('part/', 'HomeController@video_search');

//副音声検索画面へ
Route::get('fukuon_search/', 'HomeController@fukuon_search');

//videoに対する副音声の投稿数を返す
Route::get('number/{vid}', 'HomeController@number');

//トップ画面を表示
Route::get('/', 'HomeController@top');

//新着副音声一覧を表示する
Route::get('/newlist', 'HomeController@newlist');

//副音声の再生回数を１増やす
Route::get('/add/{fid}', 'HomeController@add');

//ランキング一覧を表示
Route::get('/ranking', 'HomeController@ranking');

//マイページを表示
Route::post('/mypage', 'HomeController@mypage');


//再生画面へ
Route::get('part/{video_id}/{fukuon_id}', 'HomeController@play');
//投稿画面へ
Route::get('part/{video_id}', 'HomeController@store');

//投稿
Route::post('access/', 'HomeController@access');

Route::get('/auth/{service}', 'OAuthLoginController@getGoogleAuth')->where('service', 'google');
Route::get('/auth/callback/google', 'OAuthLoginController@authGoogleCallback');

// ログインURL
// Route::get('auth/{service}', 'OAuthLoginController@getTwitterAuth')->where('service', 'twitter');
// コールバックURL
// Route::get('auth/callback/twitter', 'OAuthLoginController@authGoogleCallback');
// ログアウトURL
// Route::get('auth/twitter/logout', 'Auth\TwitterController@logout');




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
