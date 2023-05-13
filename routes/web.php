<?php

use App\Http\Middleware\Admin;
use App\Http\Controllers\FrontProductListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\SliderController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[FrontProductListController::class, 'index'])->name('homepage');

// frontend list and show 
Route::get('product/{id}',[FrontProductListController::class, 'show'])->name('product.show.frontend');
Route::get('category/{name}',[FrontProductListController::class, 'all'])->name('product.list');

// route for ajax dropdown for subcategories after clicking category 
Route::get('subcategories/{id}',[ProductController::class, 'loadSubcategory'])->name('load.subcategory');


Route::get('/add-to-cart/{product}',[CartController::class,'addToCart'])->name('add.cart');
Route::get('/cart',[CartController::class, 'showCart'])->name('cart.show');

Route::post('/product/{product}',[CartController::class, 'updateCart'])->name('cart.update');

Route::post('/product/remove/{product}',[CartController::class, 'removeCart'])->name('cart.remove');

// route for checkout 
Route::get('/checkout/{amount}',[CartController::class, 'checkOut'])->name('cart.checkout');

// route for paypal payment 
Route::post('/pay',[PaypalController::class, 'postPayment'])->name('paypal');

// route to view all product 

Route::get('all/products',[FrontProductListController::class, 'moreProducts'])->name('more.product');





Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home',function(){
    return redirect('auth/dashboard');
});

Route::group(['prefix'=>'auth'], function(){
    Route::get('/dashboard',function(){
        return view('admin.dashboard');
    })->name('dashboard');
    Route::resource('category',CategoryController::class);
    Route::resource('subcategory',SubCategoryController::class);
    Route::resource('product', ProductController::class);
    Route::get('slider/create',[SliderController::class, 'create'])->name('slider.create');
    Route::get('slider',[SliderController::class, 'index'])->name('slider');
    Route::post('slider',[SliderController::class, 'store'])->name('slider.store');
})->middleware(Admin::class);



// Route::resource('products',ProductController::class);