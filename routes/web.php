<?php


// Auth
use Illuminate\Support\Facades\Auth;

// Route
use Illuminate\Support\Facades\Route;


// Controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CatagoriesController;
use App\Http\Controllers\InvoiceItemsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UsersControllController;
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

            // Controller catagories
            Route::resource('catagories' , CatagoriesController::class);
            Route::post('multi' , [CatagoriesController::class , 'multi']);
            Route::put('multi/update/{id}' , [CatagoriesController::class , 'multiUpdate']);
            Route::post('search/category' , [CatagoriesController::class , 'search']);
            

            // Controller Products
            Route::resource('/products' , ProductsController::class);
            Route::post('/products/Filtration' , [ProductsController::class , 'Filtration'])->name('Filtration');
            Route::post('products/multi' , [ProductsController::class , 'productMulti']);

            
            // Controller InvoiceItems
            Route::resource('invoiceItems' , InvoiceItemsController::class)->only([
                'index'
            ]);
            Route::post('invoiceItems/cart' , [InvoiceItemsController::class , 'cart'])->name('cart');
            Route::post('invoiceItems/countItems' , [InvoiceItemsController::class , 'countItems'])->name('countItems');
            Route::post('invoiceItems/clear' , [InvoiceItemsController::class , 'ClearCart'])->name('clear.ClearCart');
            Route::post('invoiceItems/checkout' , [InvoiceItemsController::class , 'Checkout'])->name('Checkout');
            Route::post('invoiceItems/DeleteItem' , [InvoiceItemsController::class , 'DeleteItem'])->name('DeleteItem');

            // Controller InvoicesController
            Route::resource('invoice' , InvoicesController::class);
            Route::get('installinstallments' , [InvoicesController::class , 'installments'])->name('installments');
            Route::get('cashing' , [InvoicesController::class , 'cash'])->name('cashing');
            Route::PUT('payInvoice' , [InvoicesController::class , 'payInvoice'])->name('payInvoice');
        
            // Controller invoice


            // controller Contacts
            Route::resource('/contacts' , ChatsController::class);
            Route::resource('/Roles' , RolesController::class);
            Route::resource('/permissions' , permissionsController::class);
            Route::resource('/usersController' , UsersControllController::class);

            // get Any File On The Theme This Is Not Continue With My Project
            Route::get('/{page}', [gettheme::class, 'getShowPage']);
        });
    });
    



    



