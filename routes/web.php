<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CouponController;
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
    Route::get('coupon', [CouponController::class,'index'])->name('admin.coupon');
    Route::get('coupon/manage_coupon', [CouponController::class,'manage_coupon'])->name('admin.manage_coupon');
    Route::post('coupon/manage_coupon_process', [CouponController::class,'manage_coupon_process'])->name('admin.coupon.process');
    Route::get('coupon/manage_coupon/{id}', [CouponController::class,'manage_coupon'])->name('admin.manage_coupon.update');
    Route::get('coupon/status/{status}/{id}', [CouponController::class,'status'])->name('admin.manage_coupon.status');
    Route::get('coupon/delete/{id}', [CouponController::class,'delete'])->name('admin.coupon.delete');
});
