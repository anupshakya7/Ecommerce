<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
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

Route::prefix('admin')->group(function(){
    Route::get('/',[AdminController::class,'index'])->name('admin');
    Route::post('auth',[AdminController::class,'auth'])->name('admin.auth');
});
Route::group(['prefix'=>'admin','middleware'=>'admin_auth'],function(){
    Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('category',[CategoryController::class,'index'])->name('admin.category');
    Route::get('category/manage_category',[CategoryController::class,'manage_category'])->name('admin.manage_category');
    Route::post('category/manage_category_process',[CategoryController::class,'manage_category_process'])->name('admin.category.process');
    Route::get('category/manage_category/{id}',[CategoryController::class,'manage_category'])->name('admin.manage_category.update');
    Route::get('category/delete/{id}',[CategoryController::class,'delete'])->name('admin.category.delete');
    Route::get('admin/logout',function(){
        session()->forget('ADMIN_LOGIN');
        session()->forget('ADMIN_ID');
        session()->flash('error','Logout Successfully!!!');
        return redirect('admin');
    })->name('admin.logout');
});
