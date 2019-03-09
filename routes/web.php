<?php


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@top');
Route::get('/auth/{service}', 'OAuthLoginController@getGoogleAuth')->where('service', 'google');
Route::get('/auth/callback/google', 'OAuthLoginController@authGoogleCallback');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
