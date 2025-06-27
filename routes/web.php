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
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BookmarkController;
use App\Http\Controllers\User\LikeController;
use App\Http\Controllers\User\PaymentController;
use App\Http\Controllers\User\ReactionCommentController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ShipperController;
use App\Http\Controllers\Admin\SupportTicketAdminController;
use App\Http\Controllers\shipper\ShipperProfileController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\VoteController;


////////////////////////////////////////////////Admin///////////////////////////////////////////////////

Route::prefix('/')->group(function () {
    Route::get('/loginAdmin', [AuthController::class, 'showLoginForm'])->name('loginAdmin');
    Route::post('/loginAdmin', [AuthController::class, 'login']);
    Route::get('logoutAdmin', [AuthController::class, 'logout'])->name('logoutAdmin');
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
        Route::prefix('/products')->group(function () {
            Route::get('', [ProductsController::class, 'all'])->name('admin.product.all');
            Route::get('create', [ProductsController::class, 'create'])->name('admin.products.create');
            Route::post('', [ProductsController::class, 'store'])->name('admin.products.store');
            Route::delete('{product_id}/delete', [ProductsController::class, 'delete'])->name('admin.products.delete');
            Route::get('{product_id}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
            Route::put('{product_id}/update', [ProductsController::class, 'update'])->name('admin.products.update');
        });
        Route::prefix('/users')->group(function () {
            Route::get('', [UsersController::class, 'all'])->name('admin.users.all');
            Route::get('create', [UsersController::class, 'create'])->name('admin.users.create');
            Route::post('', [UsersController::class, 'store'])->name('admin.users.store');
            Route::get('{user_id}/edit', [UsersController::class, 'edit'])->name('admin.users.edit');
            Route::put('{user_id}/update', [UsersController::class, 'update'])->name('admin.users.update');
            Route::delete('{user_id}/delete', [UsersController::class, 'delete'])->name('admin.users.delete');
        });
        Route::prefix('/shippers')->group(function () {
            Route::get('', [ShipperController::class, 'all'])->name('admin.shippers.all');
            Route::get('create', [ShipperController::class, 'create'])->name('admin.shippers.create');
            Route::post('', [ShipperController::class, 'store'])->name('admin.shippers.store');
            Route::get('{shipper_id}/edit', [ShipperController::class, 'edit'])->name('admin.shippers.edit');
            Route::put('{shipper_id}/update', [ShipperController::class, 'update'])->name('admin.shippers.update');
            Route::delete('{shipper_id}/delete', [ShipperController::class, 'delete'])->name('admin.shippers.delete');
        });
        Route::prefix('/orders')->group(function () {
            Route::get('/', [OrdersController::class, 'all'])->name('admin.orders.all');
            Route::get('/{order}', [OrdersController::class, 'show'])->name('admin.orders.show');
            Route::get('/{order}/edit', [OrdersController::class, 'edit'])->name('admin.orders.edit');
            Route::put('/{order}', [OrdersController::class, 'update'])->name('admin.orders.update');
            Route::post('/{order}/assign-shipper', [OrdersController::class, 'assignShipper'])->name('admin.orders.assignShipper');
        });
        Route::prefix('/reports')->group(function () {
            Route::get('daily_sales', [ReportController::class, 'dailySalesReport'])->name('admin.reports.daily_sales');
            Route::get('weekly-sales', [ReportController::class, 'weeklySalesReport'])->name('admin.reports.weekly_sales');
            Route::get('monthly-sales', [ReportController::class, 'monthlySalesReport'])->name('admin.reports.monthly_sales');
            Route::get('annual-sales', [ReportController::class, 'annualSalesReport'])->name('admin.reports.annual_sales');
            Route::get('top-products', [ReportController::class, 'topSellingProducts'])->name('admin.reports.top_products');
            Route::get('top-customers', [ReportController::class, 'topCustomersReport'])->name('admin.reports.top_customers');
            Route::get('category-sales', [ReportController::class, 'categorySalesReport'])->name('admin.reports.category_sales');
            Route::get('city-sales', [ReportController::class, 'citySalesReport'])->name('admin.reports.city_sales');
        });
        Route::prefix('/payments')->group(function () {
            Route::get('', [PaymentsController::class, 'all'])->name('admin.payments.all');
        });
        Route::prefix('/tickets')->group(function () {
            Route::get('/', [SupportTicketAdminController::class, 'index'])->name('admin.tickets.index');
            Route::get('/{ticket}', [SupportTicketAdminController::class, 'show'])->name('admin.tickets.show');
            Route::post('/{ticket}/reply', [SupportTicketAdminController::class, 'reply'])->name('admin.tickets.reply');
            Route::post('/{ticket}/close', [SupportTicketAdminController::class, 'close'])->name('admin.tickets.close');
            Route::put('/{ticket}/reply/{reply}', [SupportTicketAdminController::class, 'updateReply'])->name('admin.tickets.reply.update');
        });
    });
});


///////////////////////////////////////////////User////////////////////////////////////////////////////////
Route::prefix('/')->group(function () {
    Route::get('signIn', [LoginController::class, 'signIn'])->name('sigIn');
    Route::post('register', [LoginController::class, 'store'])->name('register');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('signUp', [LoginController::class, 'signUp'])->name('signUp');
    Route::get('', [HomeUserController::class, 'index'])->name('frontend.home.all');
    Route::get('/about', [HomeUserController::class, 'about'])->name('frontend.about');
    Route::get('/contact', [HomeUserController::class, 'contact'])->name('frontend.contact');

    Route::prefix('products')->group(function () {
        Route::get('/all', [UserProductsController::class, 'all'])->name('frontend.product.all');
        Route::get('{product_id}/single', [UserProductsController::class, 'single'])->name('frontend.product.single');
        Route::get('/{productId}/like-count', [LikeController::class, 'likeCount']);
        Route::prefix('')->middleware('user.auth')->group(function () {
            Route::post('/bookmark/status', [BookmarkController::class, 'getBookmarkStatus']);
            Route::post('/bookmark/toggle', [BookmarkController::class, 'toggleBookmark']);
            Route::post('/like/status', [LikeController::class, 'getLikeStatus']);
            Route::post('/like/toggle', [LikeController::class, 'toggleLike']);
            Route::get('like', [LikeController::class, 'getLikeStatus'])->name('like');
            Route::get('/liked-products', [App\Http\Controllers\User\LikeController::class, 'getLikedProducts'])->name('user.liked.products');
            Route::POST('/unlike', [App\Http\Controllers\User\LikeController::class, 'unlikeProduct'])->name('frontend.product.unlike');
            Route::post('/{product}/comment', [App\Http\Controllers\User\CommentController::class, 'store'])->name('frontend.product.comment');
            Route::get('/comments', [App\Http\Controllers\User\CommentController::class, 'index'])->name('comments.index');
            Route::get('/user/comments/{id}/edit', [App\Http\Controllers\User\CommentController::class, 'edit'])->name('user.comments.edit');
            Route::put('/user/comments/{id}', [App\Http\Controllers\User\CommentController::class, 'update'])->name('user.comments.update');
            Route::delete('/user/comments/{id}', [App\Http\Controllers\User\CommentController::class, 'destroy'])->name('user.comments.destroy');
            Route::post('/reaction-comment', [ReactionCommentController::class, 'store'])->name('reaction.comment');
            Route::get('/recommend/{userId}', [\App\Http\Controllers\User\ProductsController::class, 'recommendProducts'])->name('user.recommendations');
        });
    });
    Route::prefix('cart')->middleware(['user.auth'])->group(function () {
        Route::get('/count', [CartController::class, 'getCartCount'])->name('frontend.cart.count');
        Route::get('{product_id}/remove', [CartController::class, 'remove'])->name('frontend.cart.remove');
        Route::post('/add-to-cart-ajax', [CartController::class, 'addAjax'])->name('frontend.cart.add.ajax');
        Route::post('/update-cart-quantity', [CartController::class, 'updateQuantity'])->name('frontend.cart.update.quantity');
        Route::post('/remove-expired/{product}', [CartController::class, 'removeExpired'])->name('cart.remove.expired');
        Route::get('/total', [CartController::class, 'getTotal']);
        Route::get('', [CartController::class, 'all'])->name('frontend.cart.all');
        Route::get('/check-reservation-status', [CartController::class, 'checkReservationStatus']);
        Route::post('/update-quantity', [\App\Http\Controllers\CartController::class, 'updateQuantity']);
    });


    Route::prefix('user')->middleware(['user.auth'])->group(function () {
        Route::get('/bookmarked-products', [App\Http\Controllers\User\BookmarkController::class, 'bookmarkedProducts'])->name('user.bookmarked.products');
        Route::post('/unbookmark', [App\Http\Controllers\User\BookmarkController::class, 'unbookmark'])->name('frontend.product.unbookmark');
        Route::get('/orders', [App\Http\Controllers\User\OrderController::class, 'index'])->name('user.orders.index');
        Route::get('/return-request/{order}', [OrderController::class, 'showForm'])->name('user.return.form');
        Route::post('/return-request/{order}', [OrderController::class, 'submit'])->name('user.return.submit');
        Route::get('/profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');
        Route::put('/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');
        Route::get('/vote/{productId}', [VoteController::class, 'show']);
        Route::post('/vote', [VoteController::class, 'store']);
    });
    Route::prefix('payment')->middleware(['user.auth'])->group(function () {
        Route::get('/redirect', [PaymentController::class, 'redirectFromBot']);
        Route::post('', [PaymentController::class, 'process'])->name('payment.process');
        Route::post('/pay', [PaymentController::class, 'pay'])->name('pay');
        Route::post('/failed', [\App\Http\Controllers\User\PaymentController::class, 'failed'])->name('payment.failed');
    });
    Route::prefix('support')->middleware(['user.auth'])->group(function () {
        Route::get('', [\App\Http\Controllers\SupportTicketController::class, 'index'])->name('frontend.support');
        Route::get('/create', [\App\Http\Controllers\SupportTicketController::class, 'create'])->name('frontend.support.create');
        Route::post('/store', [\App\Http\Controllers\SupportTicketController::class, 'store'])->name('frontend.support.store');
        Route::get('/{ticket}', [\App\Http\Controllers\SupportTicketController::class, 'show'])->name('frontend.support.show');
        Route::post('/{ticket}/reply', [\App\Http\Controllers\SupportTicketController::class, 'reply'])->name('frontend.support.reply');
        Route::put('/{ticket}/reply/{reply}', [\App\Http\Controllers\SupportTicketController::class, 'updateReply'])->name('frontend.support.reply.update');
        Route::delete('/{ticket}', [\App\Http\Controllers\SupportTicketController::class, 'destroy'])->name('frontend.support.destroy');
        Route::put('/{ticket}', [\App\Http\Controllers\SupportTicketController::class, 'update'])->name('frontend.support.update');
    });
});


////////////////////////////////////////////////shipper///////////////////////////////////////////////////

Route::prefix('/')->group(function () {
    Route::get('/loginShipper', [\App\Http\Controllers\shipper\AuthController::class, 'showLoginForm'])->name('loginShipper');
    Route::post('/loginShipper', [\App\Http\Controllers\shipper\AuthController::class, 'login'])->name('authshipper');
    Route::get('/registerShipper', [\App\Http\Controllers\shipper\AuthController::class, 'register'])->name('registerShipper');
    Route::post('/CreateShipper', [\App\Http\Controllers\shipper\AuthController::class, 'store'])->name('storeShipper');
    Route::get('logoutShipper', [\App\Http\Controllers\shipper\AuthController::class, 'logout'])->name('logoutShipper');
    Route::prefix('shipper')->middleware(['shipper.auth'])->group(function () {
        Route::prefix('orders')->group(function () {
            Route::get('', [\App\Http\Controllers\shipper\OrdersController::class, 'index'])->name('ShipperIndex');
            Route::post('/{order}/deliver', [\App\Http\Controllers\shipper\OrdersController::class, 'deliver'])->name('shipper.orders.deliver');
            Route::post('/{order}/return', [\App\Http\Controllers\shipper\OrdersController::class, 'markAsReturned'])->name('shipper.orders.return');
        });
        Route::prefix('profile')->group(function () {
            Route::get('', [ShipperProfileController::class, 'profile'])->name('shipper.profile');
            Route::put('/update', [ShipperProfileController::class, 'updateProfile'])->name('shipper.profile.update');
            Route::put('/password/update', [ShipperProfileController::class, 'updatePassword'])->name('shipper.password.update');
        });
    });
});
