<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// 一覧ページ
Route::get('/home', 'HomeController@index')->name('home');

// 新規登録ページ
Route::get('/page-register', 'HomeController@create')->name('page_register');
Route::post('/page-register', 'HomeController@store');

// 詳細ページ
Route::get('/page-show/{pageid}', 'HomeController@show')->name('page_show');
