<?php

use App\Http\Middleware\Admin;
use App\Http\Controllers\FrontProductListController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProductController;
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

Route::get('/',[FrontProductListController::class, 'index']);

Route::get('product/{id}',[FrontProductListController::class, 'show']);

// route for ajax dropdown for subcategories after clicking category 
Route::get('subcategories/{id}',[ProductController::class, 'loadSubcategory'])->name('load.subcategory');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'auth'], function(){
    Route::get('/dashboard',function(){
        return view('admin.dashboard');
    })->name('dashboard');
    
    Route::resource('category',CategoryController::class);
    
    Route::resource('subcategory',SubCategoryController::class);
    
    Route::resource('product', ProductController::class);
    
})->middleware(Admin::class);



// Route::resource('products',ProductController::class);