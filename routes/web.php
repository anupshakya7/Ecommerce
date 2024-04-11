<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SizeController;
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

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class,'index'])->name('admin');
    Route::post('auth', [AdminController::class,'auth'])->name('admin.auth');
});
Route::group(['prefix' => 'admin','middleware' => 'admin_auth'], function () {
    Route::get('dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');

    //Category
    Route::get('category', [CategoryController::class,'index'])->name('admin.category');
    Route::get('category/manage_category', [CategoryController::class,'manage_category'])->name('admin.manage_category');
    Route::post('category/manage_category_process', [CategoryController::class,'manage_category_process'])->name('admin.category.process');
    Route::get('category/manage_category/{id}', [CategoryController::class,'manage_category'])->name('admin.manage_category.update');
    Route::get('category/status/{status}/{id}', [CategoryController::class,'status'])->name('admin.category.status');
    Route::get('category/delete/{id}', [CategoryController::class,'delete'])->name('admin.category.delete');
    Route::get('admin/logout', function () {
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error', 'Logout Successfully!!!');
        return redirect('admin');
    })->name('admin.logout');

    //Coupon
    Route::prefix('coupon')->group(function () {
        Route::get('/', [CouponController::class,'index'])->name('admin.coupon');
        Route::get('/manage_coupon', [CouponController::class,'manage_coupon'])->name('admin.manage_coupon');
        Route::post('/manage_coupon_process', [CouponController::class,'manage_coupon_process'])->name('admin.coupon.process');
        Route::get('/manage_coupon/{id}', [CouponController::class,'manage_coupon'])->name('admin.manage_coupon.update');
        Route::get('/status/{status}/{id}', [CouponController::class,'status'])->name('admin.manage_coupon.status');
        Route::get('/delete/{id}', [CouponController::class,'delete'])->name('admin.coupon.delete');
    });


    //Size
    Route::prefix('size')->group(function () {
        Route::get('/', [SizeController::class,'index'])->name('admin.size');
        Route::get('/manage_size', [SizeController::class,'manage_size'])->name('admin.manage_size');
        Route::post('/manage_size_process', [SizeController::class,'manage_size_process'])->name('admin.size.process');
        Route::get('/manage_size/{id}', [SizeController::class,'manage_size'])->name('admin.manage_size.update');
        Route::get('/status/{status}/{id}', [SizeController::class,'status'])->name('admin.manage_size.status');
        Route::get('/delete/{id}', [SizeController::class,'delete'])->name('admin.size.delete');
    });

    //Color
    Route::prefix('color')->group(function () {
        Route::get('/', [ColorController::class,'index'])->name('admin.color');
        Route::get('/manage_color', [ColorController::class,'manage_color'])->name('admin.manage.color');
        Route::post('/manage_color_process', [ColorController::class,'manage_color_process'])->name('admin.color.process');
        Route::get('/manage_color/{id}', [ColorController::class,'manage_color'])->name('admin.manage_color.update');
        Route::get('/status/{status}/{id}', [ColorController::class,'status'])->name('admin.manage_color.status');
        Route::get('/delete/{id}', [ColorController::class,'delete'])->name('admin.color.delete');
    });

});
