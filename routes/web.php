<?php

use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\SubcategoryController;
use App\Http\Controllers\backend\UserController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CategotyFrontendController;
use App\Http\Controllers\frontend\ProductFrontendController;
use App\Http\Controllers\frontend\UserController as FrontendUserController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';



//Routes of category
Route::prefix('admin')->group(function () {

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::get('/categories/get', [CategoryController::class, 'categoryDataTable'])->name('get.category');
        Route::get('/categories/list', [CategoryController::class, 'getAllCategories'])->name('categories.list');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        //Route::get('/admin/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        //Routes of subcategory
        Route::get('/subcategories', [SubcategoryController::class, 'index'])->name('subcategories.index');
        Route::get('/subcategories/create', [SubcategoryController::class, 'create'])->name('subcategories.create');
        Route::post('/subcategories', [SubcategoryController::class, 'store'])->name('subcategories.store');
        Route::get('/subcategories/{subcategory}/edit', [SubcategoryController::class, 'edit'])->name('subcategories.edit');
        Route::put('/subcategories/{subcategory}', [SubcategoryController::class, 'update'])->name('subcategories.update');
        Route::delete('/subcategories/{subcategory}', [SubcategoryController::class, 'destroy'])->name('subcategories.destroy');

        //Routes of Products
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    Route::get('login', function () {
        return view('backend.auth.auth-signin');
    });

    Route::get('/master', function () {
        return view('backend.layout.master');
    });
});





//frontend routes
Route::prefix('frontend')->middleware(['auth', 'role:user'])->group(function () {
    // Route::get('/index',[CategotyFrontendController::class, 'index']);
    Route::get('/products', [ProductFrontendController::class, 'index'])->name('products.front.index');
    Route::get('/products/subcategory/{id}', [ProductFrontendController::class, 'filterBySubcategory'])->name('products.subcategory');

    //cart routes
    Route::get('/addtocart/{id}', [CartController::class, 'addToCart'])->name('frontend.add.to.cart');
    Route::get('/cart', [CartController::class, 'cart'])->name('cart');
    Route::put('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');


    //Acoount Route
    Route::get('/users/account', [FrontendUserController::class, 'index'])->name('users.account');
    Route::post('/my-account/update', [FrontendUserController::class, 'update'])->name('account.update');
});

Route::get('/', [CategotyFrontendController::class, 'index'])->name('home');

Route::get('/reg', function () {
    return view('frontend.auth.register');
})->name('frontend.regester');
Route::get('/log', function () {
    return view('frontend.auth.login');
})->name('frontend.login');
Route::get('/res', function () {
    return view('frontend.auth.reset');
});







Route::get('/checkout', function () {
    return view('frontend.pages.shop-checkout');
})->name('cart.checkout');

Route::post('/order', [CartController::class, 'order'])->name('order.post');
