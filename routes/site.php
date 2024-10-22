<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/', function () {
//    return view('front.home');
//});

//Route::group([
//    'prefix' => LaravelLocalization::setLocale(),
//    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
//], function () {
//
//    Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {
//        // must be authenticated user
//    });
//
//    Route::group(['namespace' => 'Site', 'middleware' => 'guest'], function () {
//
//        //guest  user
//
//        Route::get('login', 'LoginController@login')->name('login');
//        Route::post('login', 'LoginController@postLogin')->name('post.login');
//
//    });
//});
