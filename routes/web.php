<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CatagoriesController;
use App\Http\Controllers\Gettheme;



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


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){

    Auth::routes();

    Route::get('/', [HomeController::class, 'index'])->name('home');
    
        Route::group(['middleware' => ['auth']], function () {
    
            Route::resource('/catagories' , CatagoriesController::class);
            Route::resource('/products' , ProductsController::class);
            Route::get('/{page}', [gettheme::class, 'getShowPage']);
        });
});




    



