<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\Cart;
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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    //add
    Route::post('/addproduct', [ProductController::class, 'addproduct'])->name('addproduct.post');
    //edit
    Route::post('/editproduct/{id}', [ProductController::class, 'updateproduct'])->name('editproduct.post');
    //view
    Route::get('/productlist', [ProductController::class, 'viewproduct'])->name('productlist');
    //delete
    Route::delete('/deleteproduct/{id}', [ProductController::class, 'delete'])->name('delete.post');
});

//user
Route::middleware('auth', 'user')->group(function () {
    //view product
    // Route::get('/viewproducts', [UserController::class, 'viewproducts'])->name('viewproducts');
    Route::view('/viewproducts','userproducts')->name('viewproducts');
    //add to cart
    Route::post('/addtocart/{id}', [CartController::class, 'addcart'])->name('addtocart.post');
    //view cart
    Route::get('/viewcart', [CartController::class, 'viewcart'])->name('viewcart');
    //delete
    Route::delete('/delete/{id}', [CartController::class, 'removeall'])->name('deletecart');
    //reduce
    Route::post('/reduce/{id}', [CartController::class, 'reduce'])->name('reduce');
    //checkout
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    //view my order
    Route::get('/orders', [OrderController::class, 'myorders'])->name('myorders');
});




require __DIR__ . '/auth.php';
