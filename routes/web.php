<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', [AuthController::class, 'login']);
Route::get('login', [AuthController::class, 'login']);

Route::post('login', [AuthController::class, 'AuthLogin']);

Route::get('logout', [AuthController::class, 'logout']);

Route::get('forget-password', [AuthController::class, 'forgetpassword']);
Route::post('forget-password', [AuthController::class, 'PostForgetPassword']);

Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);


Route::group(['middleware' => 'admin'], function () {

    //  Show Admin Dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    // List Admins with Actions
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    // Add New Admin view - Add Admin
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'PostAdd']);
    // Edit Admin view - Edit Admin
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'PostEdit']);
    // Delete Admin
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);

});
Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);

});
Route::group(['middleware' => 'parent'], function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);

});
