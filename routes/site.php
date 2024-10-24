<?php

use App\Http\Controllers\Site\VerificationCodeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| site Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


route::get('/', function () {
    return view('front.home');
})->name('home');


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['namespace' => 'Site', 'middleware' => ['auth', 'VerifiedUser']], function () {
        // must be authenticated user and verified

        Route::get('profile', function () {

            return 'You Are Authenticated ';
        });
    });

    Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {
        // must be authenticated user

        Route::post('verify-user/', [VerificationCodeController::class, 'verify'])->name('verify-user');


    });

    Route::group(['namespace' => 'Site', 'middleware' => 'guest'], function () {

        //guest  user
    });
    Route::get('verify', function () {
        return view('auth.verification');
    });
});

