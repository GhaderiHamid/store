<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\HomeAdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;

use App\Http\Controllers\LikeProductController;
use App\Http\Controllers\Login\LoginController;

use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\HomeUserController;
use App\Http\Controllers\User\ProductsController as UserProductsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductLikeController;
use App\Http\Controllers\User\BasketContoller;
use App\Http\Controllers\User\BookmarkController;
use App\Http\Controllers\User\LikeController;
use App\Http\Controllers\User\VoteController;
use App\Http\Controllers\User\PaymentController;

use App\Support\Storage\Contracts\StorageInterface;

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('admin/index',function(){
//        return view('admin.index');
// });

// Route::get('test',function (){
//     dd(bcrypt('password'));
// });
// Route::get('admin/index',function (){
//     return view('admin.index');
// });

Route::get('basket/clear',function(){
    resolve(StorageInterface::class)->clear();
});

Route::get('signIn', [LoginController::class, 'signIn'])->name('sigIn');
Route::post('register',[LoginController::class, 'store'])->name('register');
Route::post('login',[LoginController::class,'login'])->name('login');
Route::get('logout',function () {
    Auth::logout(); 
})->name('logout');

Route::get('signUp', [LoginController::class, 'signUp'])->name('signUp');

Route::get('pay',[PaymentController::class, 'pay']);

Route::prefix('admin')->group(function () {
    Route::get('index', [HomeAdminController::class, 'home'])->name('admin.index');


    Route::prefix('categories')->group(function () {
        Route::get('all', [CategoriesController::class, 'all'])->name('admin.categories.all');

        Route::get('create', [CategoriesController::class, 'create'])->name('admin.categories.create');
        Route::post('', [CategoriesController::class, 'store'])->name('admin.categories.store');
        Route::delete('{category_id}/delete', [CategoriesController::class, 'delete'])->name('admin.categories.delete');
        Route::get('{category_id}/edit', [CategoriesController::class, 'edit'])->name('admin.categories.edit');
        Route::put('{category_id}/update', [CategoriesController::class, 'update'])->name('admin.categories.update');
    });

    Route::prefix('products')->group(function () {
        Route::get('', [ProductsController::class, 'all'])->name('admin.product.all');
        Route::get('create', [ProductsController::class, 'create'])->name('admin.products.create');
        Route::post('', [ProductsController::class, 'store'])->name('admin.products.store');
        Route::delete('{product_id}/delete', [ProductsController::class, 'delete'])->name('admin.products.delete');
        Route::get('{product_id}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
        Route::put('{product_id}/update', [ProductsController::class, 'update'])->name('admin.products.update');
    });
    Route::prefix('users')->group(function () {
        Route::get('', [UsersController::class, 'all'])->name('admin.users.all');
        Route::get('create', [UsersController::class, 'create'])->name('admin.users.create');
        Route::post('', [UsersController::class, 'store'])->name('admin.users.store');
        Route::get('{user_id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
        Route::put('{user_id}/update', [UsersController::class, 'update'])->name('admin.users.update');
        Route::delete('{user_id}/delete', [UsersController::class, 'delete'])->name('admin.users.delete');
    });
    Route::prefix('orders')->group(function () {
        Route::get('', [OrdersController::class, 'all'])->name('admin.orders.all');
    });
    Route::prefix('payments')->group(function () {
        Route::get('', [PaymentsController::class, 'all'])->name('admin.payments.all');
    });
});

Route::prefix('')->group(function () {


     Route::get('', [HomeUserController::class, 'index'])->name('frontend.home.all');
     Route::prefix('products')->group (function () {
        Route::get('/all', [UserProductsController::class, 'all'])->name('frontend.product.all');
        Route::get('{product_id}/single', [UserProductsController::class,'single'])->name('frontend.product.single');
        
        Route::get('{product_id}/add', [CartController::class, 'add'])->name('frontend.cart.add');
        Route::get('{product_id}/remove', [CartController::class, 'remove'])->name('frontend.cart.remove');

    });
    // Route::get('cart', [CartController::class,'all'])->name('frontend.cart.all');



    

});


// Route::post('/toggle-like', [LikeController::class, 'toggleLike'])->middleware('auth');
Route::post('/like/toggle', [LikeController::class, 'toggleLike']);
Route::post('/like/status', [LikeController::class, 'getLikeStatus'])->middleware('auth');


Route::post('/bookmark/toggle', [BookmarkController::class, 'toggleBookmark']);
Route::post('/bookmark/status', [BookmarkController::class, 'getBookmarkStatus'])->middleware('auth');


Route::get('/vote/{productId}', [VoteController::class, 'show']);
Route::post('/vote', [VoteController::class, 'store']);



Route::get('basket/add/{product}',[BasketContoller::class,'add'])->name('basket.add');
// Route::get('basket',[BasketContoller::class, 'index'])->name('basket.index');
Route::get('cart', [BasketContoller::class, 'index'])->name('frontend.cart.all');

Route::get('checkout', [BasketContoller::class, 'checkout'])->name('checkout');

Route::post('payment/{gateway}/callback',[PaymentController::class, 'verify'])->name('payment.verify');

Route::get('like',[LikeController::class, 'getLikeStatus'])->name('like');

Route::get('/user/liked-products', [App\Http\Controllers\User\LikeController::class, 'getLikedProducts'])->name('user.liked.products');

Route::POST('/product/unlike', [App\Http\Controllers\User\LikeController::class, 'unlikeProduct'])->name('frontend.product.unlike');

Route::middleware('auth')->group(function () {
    Route::get('/bookmarked-products', [App\Http\Controllers\User\BookmarkController::class, 'bookmarkedProducts'])->name('user.bookmarked.products');
    Route::post('/unbookmark', [App\Http\Controllers\User\BookmarkController::class, 'unbookmark'])->name('frontend.product.unbookmark');
    Route::get('/user/orders', [App\Http\Controllers\User\OrderController::class, 'index'])->name('user.orders.index');
});