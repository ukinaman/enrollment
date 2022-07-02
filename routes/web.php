<?php

use App\Models\Subject;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\SemestralFeeController;

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

Route::get('/', function(){
    return view('student.index');
})->name('welcome');

Route::controller(StudentController::class)->group(function () {
    // Registrar Student Section
    Route::get('/student', 'index')->name('courses.index');
    // Student Registration Form
    Route::get('/enroll', 'create')->name('student.create');
    Route::post('/enroll', 'store')->name('student.store');
    Route::get('/assessment/{id}', 'assessment')->name('student.assessment');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
Route::get('/accounting', [App\Http\Controllers\AccountingController::class, 'index'])->name('accounting.index');

Route::middleware('auth')->group(function () {
    Route::controller(CourseController::class)->group(function () {
        Route::get('/courses', 'index')->name('courses.index');
        Route::get('/courses/create', 'create')->name('courses.create');
        Route::post('/courses/store', 'store')->name('courses.store');
        Route::get('/courses/show/{id}', 'show')->name('course.show');
    });
    Route::controller(SubjectController::class)->group(function () {
        Route::get('/subjects', 'index')->name('subject.index');
        Route::get('/subjects/create', 'create')->name('subject.create');
        Route::get('/subjects/show', 'show')->name('subject.show');
        Route::get('/subjects/upload-view', 'getUploadView')->name('subject.uploadBlade');
        Route::post('/subjects/upload', 'uploadSubjects')->name('subject.upload');
    });
    Route::controller(SemestralFeeController::class)->group(function () {
        Route::get('/semestral-fee', 'index')->name('semfee.index');
        Route::get('/semestral-fee/create', 'create')->name('semfee.create');
        Route::post('/semestral-fee/store', 'store')->name('semfee.store');
        Route::get('/semestral-fee/edit/{id}', 'edit')->name('semfee.edit');
        Route::put('/semestral-fee/update/{id}', 'update')->name('semfee.update');
        Route::get('/semestral-fee/show/{id}', 'show')->name('assessment.show');
    });
    Route::controller(AssessmentController::class)->group(function () {
        Route::get('/accounting/assessment', 'index')->name('assessment.index');
        Route::get('/accounting/assessment/show', 'show')->name('assessment.show');
    });

    
    Route::get('/user-management', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/user-management/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('/user-management/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('/roles-and-permission', [App\Http\Controllers\RolesPermissionController::class, 'index'])->name('roles.index');
    Route::get('/roles-and-permission/create', [App\Http\Controllers\RolesPermissionController::class, 'create'])->name('roles.create');
    Route::post('/roles-and-permission/store', [App\Http\Controllers\RolesPermissionController::class, 'store'])->name('roles.store');
});

Route::get('/rle', function()
{
    $subjects = Subject::where([['course_id','=',3],['year_id','=',1],['sem_id','=',1],['code','not like','%RLE%']])->get();
    // dd($excluded_rle);
    dd($subjects);
});
