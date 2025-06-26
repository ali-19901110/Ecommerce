<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SubcategoryController;
use App\Http\Controllers\ProfileController;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin', function(){
    return view('admin');
})->middleware(['auth', 'role:user']);

Route::get('/master', function(){
    return view('backend.layout.master');
});


//Routes of category
Route::get('/categories', [CategoryController::class,'index'])->name('categories.index');
Route::get('/categories/create',[CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class,'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

//Routes of subcategory
Route::get('/subcategories', [SubcategoryController::class,'index'])->name('subcategories.index');
Route::get('/subcategories/create',[SubcategoryController::class, 'create'])->name('subcategories.create');
Route::post('/subcategories', [SubcategoryController::class,'store'])->name('subcategories.store');
Route::get('/subcategories/{subcategory}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
Route::put('/subcategories/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategories.update');
Route::delete('/subcategories/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');

//Routes of subcategory
Route::get('/products', [ProductController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class,'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');


// Route::get('/test', function(){
//     return view('frontend.layouts.master');
// });

Route::get('/test', function () {
    return view('frontend.layouts.master');
});