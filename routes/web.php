<?php

use App\Http\Controllers\AuthController;
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

/* Route::get('/', function () {
    return view('welcome');
}); */

// Open Login Page & Check which Role
Route::get('/', [AuthController::class, 'login']);
// Whenever Click Login
Route::post('login', [AuthController::class, 'AuthLogin']);
// Whenever Click Logout
Route::get('logout', [AuthController::class, 'logout']);



// MiddleWares Groups

Route::group(['middleware' => 'admin'], function () {

    Route::get('admin/dashboard', function () {
        return view('admin.dashboard');
    });

    Route::get('admin/admin/list', function () {
        return view('admin.admin.list');
    });


});

Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', function () {
        return view('teacher.dashboard');
    });

});
Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', function () {
        return view('student.dashboard');
    });

});
Route::group(['middleware' => 'parent'], function () {
    Route::get('parent/dashboard', function () {
        return view('parent.dashboard');
    });

});
