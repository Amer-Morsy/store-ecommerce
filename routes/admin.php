<?php

use App\Http\Controllers\Dashboard\BrandsController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\LoginController;
use App\Http\Controllers\Dashboard\MainCategoriesController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\SettingsController;
use App\Http\Controllers\Dashboard\SubCategoriesController;
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

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [
        'localeSessionRedirect',
        'localizationRedirect',
        'localeViewPath'
    ]
], function () {

### start auth routes ###################################################################################
    Route::group([
        'namespace' => 'Dashboard',
        'prefix' => 'admin',
        'middleware' => 'auth:admin'
    ], function () {
    ### start index|logout routes ##############################################################
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
    ### end index|logout routes #################################################################
    ### start settings routes ##########################################################################
        Route::group(['prefix' => 'settings'], function () {
            Route::get('shipping-methods/{type}', [SettingsController::class, 'editShippingMethods'])
                ->name('edit.shippings.methods');
            Route::put('shipping-methods/{id}', [SettingsController::class, 'updateShippingMethods'])
                ->name('update.shippings.methods');
        });
    ### end settings routes ############################################################################
    ### start profile routes ###################################################
        Route::group(['prefix' => 'profile'], function () {
            Route::get('edit', [ProfileController::class, 'editProfile'])
                ->name('edit.profile');
            Route::put('update', [ProfileController::class, 'updateProfile'])
                ->name('update.profile');
        });
    ### end profile routes ######################################################
    ### start Categories routes ###################################################
       Route::group(['prefix' => 'main_categories'], function () {
           Route::get('/',[MainCategoriesController::class, 'index']) -> name('admin.maincategories');
           Route::get('create',[MainCategoriesController::class, 'create']) -> name('admin.maincategories.create');
           Route::post('store',[MainCategoriesController::class, 'store']) -> name('admin.maincategories.store');
           Route::get('edit/{id}',[MainCategoriesController::class, 'edit']) -> name('admin.maincategories.edit');
           Route::post('update/{id}',[MainCategoriesController::class, 'update']) -> name('admin.maincategories.update');
           Route::get('delete/{id}',[MainCategoriesController::class, 'destroy']) -> name('admin.maincategories.delete');
       });
    ### end Categories routes #####################################################

        ################################## brands routes ######################################
        Route::group(['prefix' => 'brands'], function () {
            Route::get('/',[BrandsController::class, 'index']) -> name('admin.brands');
            Route::get('create',[BrandsController::class, 'create']) -> name('admin.brands.create');
            Route::post('store',[BrandsController::class, 'store']) -> name('admin.brands.store');
            Route::get('edit/{id}',[BrandsController::class, 'edit']) -> name('admin.brands.edit');
            Route::post('update/{id}',[BrandsController::class, 'update']) -> name('admin.brands.update');
            Route::get('delete/{id}',[BrandsController::class, 'destroy']) -> name('admin.brands.delete');
        });
        ################################## end brands    #######################################

    });
### end auth routes ###################################################################################

### start guest routes ################################################################################
    Route::group([
        'namespace' => 'Dashboard',
        'prefix' => 'admin',
        'middleware' => 'guest:admin'
    ], function () {
    ### start login routes #############################################################################
        Route::get('login', [LoginController::class, 'login'])->name('admin.login');
        Route::post('login', [LoginController::class, 'loginCheck'])->name('admin.post.login');
    ### end login routes ###############################################################################
    });
### end guest routes ################################################################################

});
