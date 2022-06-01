<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
Route::get('/accounting', [App\Http\Controllers\AccountingController::class, 'index'])->name('accounting.index');

Route::controller(CourseController::class)->group(function () {
    Route::get('/courses', 'index')->name('courses.index');
    Route::get('/courses/create', 'create')->name('courses.create');
});

Route::get('/user-management', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
Route::get('/user-management/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
Route::post('/user-management/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
Route::get('/roles-and-permission', [App\Http\Controllers\RolesPermissionController::class, 'index'])->name('roles.index');
