<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
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


// ** AUTH **
Route::get('/', [AuthController::class, 'login']);
Route::get('login', [AuthController::class, 'login']);
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);

// ** Forget Password **
Route::get('forget-password', [AuthController::class, 'forgetpassword']);
Route::post('forget-password', [AuthController::class, 'PostForgetPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'PostReset']);


// !!! MIDDLE WARES GROUPS

// ?? ADMIN GROUP ??
Route::group(['middleware' => 'admin'], function () {

    // ? Dashboard
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);

    // ? Admin
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'PostAdd']);
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'PostEdit']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    // ? Student
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'PostAdd']);

    // ? Class
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'PostAdd']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'PostEdit']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

    // ? Subject
    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'PostAdd']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'PostEdit']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    // ? Assign-Subject
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'PostAdd']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'editSingle']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'updateSingle']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'PostEdit']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);

    // ? Change Password
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);


});

// ?? Teacher GROUP ??
Route::group(['middleware' => 'teacher'], function () {
    // ? Show Dashboard
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    // ? Change Password
    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);

});

// ?? Student GROUP ??
Route::group(['middleware' => 'student'], function () {
    // ? Show Dashboard
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
    // ? Change Password
    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);

});

// ?? Parent GROUP ?? 
Route::group(['middleware' => 'parent'], function () {
    // ? Show Dashboard
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);
    // ? Change Password
    Route::get('parent/change_password', [UserController::class, 'change_password']);
    Route::post('parent/change_password', [UserController::class, 'update_change_password']);

});
