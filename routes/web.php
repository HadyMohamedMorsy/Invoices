<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CatagoriesController;
use App\Http\Controllers\InvoiceItemsController;
use App\Http\Controllers\InvoicesController;
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
    
            Route::resource('catagories' , CatagoriesController::class);
            Route::post('multi' , [CatagoriesController::class , 'multi']);
            Route::post('search/category' , [CatagoriesController::class , 'search']);
            Route::resource('/products' , ProductsController::class);

            // Controller InvoiceItems
            Route::resource('/invoices' , InvoiceItemsController::class)->only([
                'index'
            ]);
            Route::post('invoices/cart' , [InvoiceItemsController::class , 'cart']);
            Route::post('invoices/countItems' , [InvoiceItemsController::class , 'countItems']);
            Route::post('invoices/clear' , [InvoiceItemsController::class , 'ClearCart'])->name('clear.ClearCart');
            Route::post('invoices/checkout' , [InvoiceItemsController::class , 'Checkout'])->name('Checkout');
            Route::post('invoices/DeleteItem' , [InvoiceItemsController::class , 'DeleteItem'])->name('DeleteItem');

            
            // Controller InvoicesController
            Route::get('invoicesItems/install' , [InvoicesController::class , 'installments'])->name('installments');
            Route::resource('invoicesItems' , InvoicesController::class);
            
            Route::get('/{page}', [gettheme::class, 'getShowPage']);
        });
    });
    



    



