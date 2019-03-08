<?php


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', 'HomeController@top');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
