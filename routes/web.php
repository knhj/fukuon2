<?php


//listとsearchへ
Route::get('/', 'HomeController@top');
//再生画面へ
Route::get('part/{video_id}/{fukuon_id}', 'HomeController@play');
//投稿画面へ
Route::get('part/{video_id}', 'HomeController@store');

//play_countに1加える。
// Route::get('/play_count_add/{fukuon_id}', 'Api\ApiController@play_count_add');


Route::get('/auth/{service}', 'OAuthLoginController@getGoogleAuth')->where('service', 'google');
Route::get('/auth/callback/google', 'OAuthLoginController@authGoogleCallback');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
