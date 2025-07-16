<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WebUserController;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\WebsiteUserMiddleware;
use App\Http\Controllers\WebController;

Route::get('/admin-login', function () {
    return view('authdashboard.signin');
});

// Auth: Register & Login
Route::get('/signup', [DashboardController::class, 'Authregister'])->name('signup');
Route::post('/signup', [DashboardController::class, 'RegisterForm'])->name('signup');

Route::get('/signin', [DashboardController::class, 'Authlogin'])->name('signin');
Route::post('/signin', [DashboardController::class, 'LoginForm'])->name('signin');

// Password change 
Route::get('/pass/{id}', [WebUserController::class, 'password'])->name('password');
Route::put('/pass/{id}', [WebUserController::class, 'ChangePass'])->name('password.update');

// Signout Routes
Route::post('/signout', [WebUserController::class, 'signout'])->name('signout');
Route::post('/admin/signout', [AdminController::class, 'AdminSignout'])->name('admin.signout');

// Sample Design 
Route::get('/user/table', [WebUserController::class, 'Table_show'])->name('user.table');
Route::get('/admin/table', [AdminController::class, 'Tableshow'])->name('admin.table');

Route::get('/users/pending', [AdminController::class, 'showPendingUsers'])->name('admin.user.pending');
Route::get('/users/approved', [AdminController::class, 'showApprovedUsers'])->name('admin.user.approved');

Route::post('/users/bulk-status-update', [AdminController::class, 'updateallstatus'])->name('admin.users.bulk.status.update');
Route::post('/user/ajax-toggle-status', [AdminController::class, 'JsStatusUpdate'])->name('admin.user.ajax.toggle');


Route::middleware(['user'])->group(function () {
    Route::get('/user/home2', [WebUserController::class, 'Home_show'])->name('user.home2');
    Route::get('/user/inquiry', [WebUserController::class, 'Inquiry'])->name('user.inquiry');
    Route::post('/user/inquiry', [WebUserController::class, 'Form'])->name('user.inquiry');
    Route::get('/user/inquiry-list', [WebUserController::class, 'Inquirylist'])->name('user.inquiry-list');
    Route::get('/user/inquiry/{id}/edit', [WebUserController::class, 'edit'])->name('user.edit');
    Route::put('/user/inquiry/{id}', [WebUserController::class, 'update'])->name('user.update');
    Route::delete('/user/inquiry/{id}', [WebUserController::class, 'destroy'])->name('user.delete');
    Route::get('/inquiries/pending', [WebUserController::class, 'pending'])->name('inquiries.pending');
    Route::post('/inquiries/{id}/approve', [WebUserController::class, 'approve'])->name('inquiries.approve');
    Route::get('/inquiries/approved', [WebUserController::class, 'approved'])->name('inquiries.approved');
    Route::post('/inquiries/{id}/deactive', [WebUserController::class, 'deactive'])->name('inquiries.deactive');
    Route::get('/user/change-pass', [WebUserController::class, 'change'])->name('user.change-pass');
    Route::get('/user/profile', [WebUserController::class, 'profile'])->name('user.profile.show');
    Route::put('/user/profile/update', [WebUserController::class, 'Profileupdate'])->name('user.profile.update');
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin/home2', [AdminController::class, 'Homeshow'])->name('admin.home2');
    Route::get('/admin/user-list', [AdminController::class, 'userlist'])->name('admin.user.list');
    Route::get('/admin/inquiry_list', [AdminController::class, 'Iquiryadmin'])->name('admin.inquiry_list');
    Route::get('/admin/pending-users', [AdminController::class, 'pendingUsers'])->name('admin.pending');
    Route::post('/admin/approve-user/{id}', [AdminController::class, 'approveUser'])->name('admin.approve');
    Route::get('/admin/approved-users', [AdminController::class, 'approvedUsers'])->name('admin.approved');
    Route::post('/admin/approved-users/{id}', [AdminController::class, 'deactivate'])->name('admin.deactivate');
    Route::post('/admin/inquiry/{id}/reply', [AdminController::class, 'reply'])->name('admin.inquiry.reply');
    Route::get('/admin/inactive-users', [AdminController::class, 'InactiveUsers'])->name('admin.inactive');
    Route::post('/admin/active-user/{id}', [AdminController::class, 'activetheuser'])->name('admin.active');
    Route::get('/admin/products', [AdminController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [AdminController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [AdminController::class, 'store'])->name('admin.products.store');
    Route::get('/admin/products/{product}/edit', [AdminController::class, 'edit'])->name('admin.products.edit');
    Route::put('/admin/products/{product}', [AdminController::class, 'update'])->name('admin.products.update');
    Route::delete('/admin/products/{product}', [AdminController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('/admin/products/{product}/images', [AdminController::class, 'show'])->name('admin.product.images');
    Route::post('/admin/product/images/upload/{productId}', [AdminController::class, 'uploadImages'])->name('admin.product.images.upload');
    Route::get('/admin/product/images/upload/{productId}', [AdminController::class, 'uploadImages'])->name('admin.product.images.upload');
    Route::delete('/admin/product/images/destroy/{id}', [AdminController::class, 'destroyImage'])->name('admin.product.images.destroy');
    Route::post('admin/bulk-delete', [AdminController::class, 'bulkDelete'])->name('admin.bulkDelete');
    Route::post('admin/bulk-activate', [AdminController::class, 'bulkActivate'])->name('admin.bulkActivate');
    Route::post('admin/bulk-deactivate', [AdminController::class, 'bulkDeactivate'])->name('admin.bulkDeactivate');
    Route::get('/admin/categories', [AdminController::class, 'category'])->name('admin.categories.index');
    Route::get('/admin/categories/create', [AdminController::class, 'createe'])->name('admin.categories.create');
    Route::post('/admin/categories', [AdminController::class, 'stored'])->name('admin.categories.store');
    Route::post('/admin/categories/{category}/update', [AdminController::class, 'updated'])->name('admin.categories.update');
    Route::delete('/admin/categories/{category}', [AdminController::class, 'destroyed'])->name('admin.categories.destroy');
    Route::post('/admin/delete', [AdminController::class, 'Delete'])->name('admin.Delete');
    Route::post('/admin/activate-bulk', [AdminController::class, 'ActivateBulk'])->name('admin.ActivateBulk');
    Route::post('/admin/deactivate-bulk', [AdminController::class, 'DeactivateBulk'])->name('admin.DeactivateBulk');
    Route::get('/admin/orders', [AdminController::class, 'order'])->name('admin.orders.index');
    Route::get('/admin/invoice/{orderId}', [AdminController::class, 'invoice'])->name('admin.invoice.show');
    Route::get('/admin/invoice/pdf/{orderId}', [AdminController::class, 'invoicePDF'])->name('admin.invoice.pdf');
    Route::get('/admin/invoice/{orderId}', [AdminController::class, 'downloadInvoice'])->name('admin.invoice.pdf');
});

Route::middleware(['website.user'])->group(function () {
    Route::get('/cart', [WebController::class, 'View'])->name('cart.view');
    Route::get('/wishlist', [WebController::class, 'wishlist'])->name('wishlist');
    Route::get('/checkout/page', [WebController::class, 'checkout'])->name('checkout.page');
    Route::post('/checkout', [WebController::class, 'store'])->name('checkout.store');
});

//website routes
Route::get('/', [WebController::class, 'homepage'])->name('welcome');
Route::get('/load-more-categories', [WebController::class, 'loadMoreCategories'])->name('load.more.categories');
Route::get('/login', [WebController::class, 'showLoginForm'])->name('website.login');
Route::post('/login', [WebController::class, 'login']);
Route::get('/register', [WebController::class, 'showRegisterForm'])->name('website.register');
Route::post('/register', [WebController::class, 'register']);
Route::get('/logout', [WebController::class, 'logout'])->name('website.logout');
Route::get('/search', [WebController::class, 'search'])->name('search.products');
Route::get('/category/{category}', [WebController::class, 'productsByCategory'])->name('category.products');
Route::get('/products/filter', [WebController::class, 'filter'])->name('products.filter');