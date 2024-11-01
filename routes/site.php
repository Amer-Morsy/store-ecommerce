<?php

use App\Http\Controllers\Site\CategoryController;
use App\Http\Controllers\Site\HomeController;
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


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::group(['namespace' => 'Site', 'middleware' => 'guest'], function () {
        //guest  user
        route::get('category/{slug}', [CategoryController::class, 'productsBySlug'])->name('category');
    });

    Route::group(['namespace' => 'Site', 'middleware' => 'auth'], function () {
        // must be authenticated user
        Route::post('verify-user/', [VerificationCodeController::class, 'verify'])->name('verify-user');
        Route::get('verify', [VerificationCodeController::class, 'getVerifyPage'])->name('get.verification.form');
    });

    Route::group(['namespace' => 'Site', 'middleware' => ['auth', 'VerifiedUser']], function () {
        // must be authenticated user and verified
        route::get('/', [HomeController::class, 'home'])->name('home');
    });


});
