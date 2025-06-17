<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\HomeAdminController;

use App\Http\Controllers\Admin\OrdersController;
use App\Http\Controllers\Admin\PaymentsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UsersController;


use App\Http\Controllers\Login\LoginController;

use App\Http\Controllers\User\CartController;

use App\Http\Controllers\User\HomeUserController;
use App\Http\Controllers\User\ProductsController as UserProductsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User\BasketContoller;
use App\Http\Controllers\User\BookmarkController;
use App\Http\Controllers\User\LikeController;
use App\Http\Controllers\User\VoteController;
use App\Http\Controllers\User\PaymentController;

use App\Http\Controllers\User\ReactionCommentController;
use App\Http\Controllers\User\UserProfileController as UserUserProfileController;
use App\Http\Controllers\User\UserProfileController;
use App\Support\Storage\Contracts\StorageInterface;
use App\Http\Controllers\Admin\AuthController;


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


Route::get('signIn', [LoginController::class, 'signIn'])->name('sigIn');
Route::post('register',[LoginController::class, 'store'])->name('register');
Route::post('login',[LoginController::class,'login'])->name('login');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

Route::get('signUp', [LoginController::class, 'signUp'])->name('signUp');


Route::get('/loginAdmin', [AuthController::class, 'showLoginForm'])->name('loginAdmin');
Route::post('/loginAdmin', [AuthController::class, 'login']);
Route::get('logoutAdmin',[AuthController::class, 'logout'])->name('logoutAdmin');
Route::prefix('admin')->middleware(['admin.auth'])->group(function () {

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
    Route::prefix('/orders')->group(function () {
        Route::get('/', [OrdersController::class, 'all'])->name('admin.orders.all');
        Route::get('/{order}', [OrdersController::class, 'show'])->name('admin.orders.show');
        Route::get('/{order}/edit', [OrdersController::class, 'edit'])->name('admin.orders.edit');
        Route::put('/{order}', [OrdersController::class, 'update'])->name('admin.orders.update');
    });
    Route::prefix('reports')->group(function () {
       
        Route::get('daily_sales', [\App\Http\Controllers\Admin\ReportController::class, 'dailySalesReport'])->name('admin.reports.daily_sales');
        Route::get('weekly-sales', [ReportController::class, 'weeklySalesReport'])->name('admin.reports.weekly_sales');
        Route::get('monthly-sales', [\App\Http\Controllers\Admin\ReportController::class, 'monthlySalesReport'])->name('admin.reports.monthly_sales');
        Route::get('annual-sales', [ReportController::class, 'annualSalesReport'])->name('admin.reports.annual_sales');
        Route::get('top-products', [ReportController::class, 'topSellingProducts'])->name('admin.reports.top_products');
        Route::get('top-customers', [ReportController::class, 'topCustomersReport'])->name('admin.reports.top_customers');
    });
    
    Route::prefix('payments')->group(function () {
        Route::get('', [PaymentsController::class, 'all'])->name('admin.payments.all');
    });
    // مدیریت تیکت‌های کاربران
    Route::get('tickets', [\App\Http\Controllers\Admin\SupportTicketAdminController::class, 'index'])->name('admin.tickets.index');
    Route::get('tickets/{ticket}', [\App\Http\Controllers\Admin\SupportTicketAdminController::class, 'show'])->name('admin.tickets.show');
    Route::post('tickets/{ticket}/reply', [\App\Http\Controllers\Admin\SupportTicketAdminController::class, 'reply'])->name('admin.tickets.reply');
    Route::post('tickets/{ticket}/close', [\App\Http\Controllers\Admin\SupportTicketAdminController::class, 'close'])->name('admin.tickets.close');
    // افزودن route ویرایش پاسخ
    Route::put('tickets/{ticket}/reply/{reply}', [\App\Http\Controllers\Admin\SupportTicketAdminController::class, 'updateReply'])->name('admin.tickets.reply.update');
});

Route::prefix('')->group(function () {


     Route::get('', [HomeUserController::class, 'index'])->name('frontend.home.all');
    Route::get('/about', function () {
        return view('frontend.home.about');
    })->name('frontend.about');
      Route::get('/contact', function () {
        return view('frontend.home.contact');
    })->name('frontend.contact');
     Route::prefix('products')->group (function () {
        Route::get('/all', [UserProductsController::class, 'all'])->name('frontend.product.all');
        Route::get('{product_id}/single', [UserProductsController::class,'single'])->name('frontend.product.single');
        
        Route::get('{product_id}/add', [CartController::class, 'add'])->name('frontend.cart.add');
        Route::get('{product_id}/remove', [CartController::class, 'remove'])->name('frontend.cart.remove');

        // افزودن به سبد خرید با AJAX
        Route::post('/add-to-cart-ajax', [CartController::class, 'addAjax'])->name('frontend.cart.add.ajax');
        // بروزرسانی تعداد محصول در سبد خرید با AJAX
        Route::post('/update-cart-quantity', [CartController::class, 'updateQuantity'])->name('frontend.cart.update.quantity');
    });
    Route::get('cart', [CartController::class,'all'])->name('frontend.cart.all');




});


// Route::post('/toggle-like', [LikeController::class, 'toggleLike'])->middleware('auth');
Route::post('/like/toggle', [LikeController::class, 'toggleLike']);
Route::post('/like/status', [LikeController::class, 'getLikeStatus'])->middleware('user.auth');


Route::post('/bookmark/toggle', [BookmarkController::class, 'toggleBookmark']);
Route::post('/bookmark/status', [BookmarkController::class, 'getBookmarkStatus'])->middleware('user.auth');


Route::get('/vote/{productId}', [VoteController::class, 'show']);
Route::post('/vote', [VoteController::class, 'store']);



// Route::get('basket',[BasketContoller::class, 'index'])->name('basket.index');



Route::get('like',[LikeController::class, 'getLikeStatus'])->name('like');

Route::get('/user/liked-products', [App\Http\Controllers\User\LikeController::class, 'getLikedProducts'])->name('user.liked.products');

Route::POST('/product/unlike', [App\Http\Controllers\User\LikeController::class, 'unlikeProduct'])->name('frontend.product.unlike');

Route::post('/product/{product}/comment', [App\Http\Controllers\User\CommentController::class, 'store'])->name('frontend.product.comment');

Route::get('/comments', [App\Http\Controllers\User\CommentController::class, 'index'])->name('comments.index');

Route::get('/user/comments/{id}/edit', [App\Http\Controllers\User\CommentController::class, 'edit'])->name('user.comments.edit');
Route::put('/user/comments/{id}', [App\Http\Controllers\User\CommentController::class, 'update'])->name('user.comments.update');

Route::delete('/user/comments/{id}', [App\Http\Controllers\User\CommentController::class, 'destroy'])->name('user.comments.destroy');

Route::middleware('user.auth')->group(function () {
    Route::get('/bookmarked-products', [App\Http\Controllers\User\BookmarkController::class, 'bookmarkedProducts'])->name('user.bookmarked.products');
    Route::post('/unbookmark', [App\Http\Controllers\User\BookmarkController::class, 'unbookmark'])->name('frontend.product.unbookmark');
    Route::get('/user/orders', [App\Http\Controllers\User\OrderController::class, 'index'])->name('user.orders.index');
    Route::get('/user/profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
    Route::put('/user/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
});

Route::post('/reaction-comment', [ReactionCommentController::class, 'store'])->name('reaction.comment');


// Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');
Route::get('/payment/redirect', [PaymentController::class, 'redirectFromBot']);
Route::post('/payment', [PaymentController::class, 'process'])->name('payment.process');
Route::post('payment/pay', [PaymentController::class, 'pay'])->name('pay');
Route::post('/payment/failed', [\App\Http\Controllers\User\PaymentController::class, 'failed'])->name('payment.failed');

// تعداد لایک‌های یک محصول (برای ajax)
Route::get('/product/{productId}/like-count', [App\Http\Controllers\User\LikeController::class, 'likeCount']);


Route::get('/recommend/{userId}', [\App\Http\Controllers\User\ProductsController::class, 'recommendProducts'])->name('user.recommendations');


Route::middleware(['user.auth'])->group(function () {
    Route::get('/support', [\App\Http\Controllers\SupportTicketController::class, 'index'])->name('frontend.support');
    Route::get('/support/create', [\App\Http\Controllers\SupportTicketController::class, 'create'])->name('frontend.support.create');
    Route::post('/support/store', [\App\Http\Controllers\SupportTicketController::class, 'store'])->name('frontend.support.store');
    Route::get('/support/{ticket}', [\App\Http\Controllers\SupportTicketController::class, 'show'])->name('frontend.support.show');
    Route::post('/support/{ticket}/reply', [\App\Http\Controllers\SupportTicketController::class, 'reply'])->name('frontend.support.reply');
    Route::put('/support/{ticket}/reply/{reply}', [\App\Http\Controllers\SupportTicketController::class, 'updateReply'])->name('frontend.support.reply.update');
    Route::delete('/support/{ticket}', [\App\Http\Controllers\SupportTicketController::class, 'destroy'])->name('frontend.support.destroy');
    Route::put('/support/{ticket}', [\App\Http\Controllers\SupportTicketController::class, 'update'])->name('frontend.support.update');
});

Route::post('/cart/update-quantity', [\App\Http\Controllers\CartController::class, 'updateQuantity']);

