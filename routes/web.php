<?php

use App\Models\Subject;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\DownpaymentController;
use App\Http\Controllers\SemestralFeeController;
use App\Http\Controllers\StudentDiscountController;
use App\Http\Controllers\StudentAssessmentController;
use App\Http\Controllers\EnrolleeAssessmentController;

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

Route::controller(StudentController::class)->prefix('student')->group(function () {
    // Registrar Student Section
    Route::get('/', 'index')->name('courses.index');
    // Student Registration Form
    Route::get('/enroll', 'create')->name('student.create');
    Route::post('/enroll/course', 'storeCourse')->name('student.course');
    Route::get('/enroll/register/{enrollment_id}', 'createResgister')->name('student.register.create');
    Route::post('/enroll/register/store/{enrollment_id}', 'storeStudent')->name('student.register');
    Route::get('/enroll/mop/{enrollment_id}', 'createMop')->name('student.mop.create');
    Route::post('/enroll/mode-of-payment/{enrollment_id}', 'storeMop')->name('student.mop');
    Route::get('/assessment/{enrollment_id}/{table}', 'assessment')->name('student.assessment');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/students', [App\Http\Controllers\StudentController::class, 'index'])->name('students.index');
Route::get('/accounting', [App\Http\Controllers\AccountingController::class, 'index'])->name('accounting.index');

Route::middleware('auth')->group(function () {
    // Regsitrar
    Route::controller(CourseController::class)->prefix('courses')->group(function () {
        Route::get('/', 'index')->name('courses.index');
        Route::get('/create', 'create')->name('courses.create');
        Route::post('/store', 'store')->name('courses.store');
        Route::get('/show/{id}', 'show')->name('course.show');
        Route::get('/subjects', 'getSubject')->name('course.subjects');
    });
    Route::controller(SubjectController::class)->prefix('subjects')->group(function () {
        Route::get('/', 'index')->name('subject.index');
        Route::get('/create', 'create')->name('subject.create');
        Route::get('/show', 'show')->name('subject.show');
        Route::get('/upload-view', 'getUploadView')->name('subject.uploadBlade');
        Route::post('/upload', 'uploadSubjects')->name('subject.upload');
    });
    Route::controller(StudentAssessmentController::class)->prefix('/registrar/student-assessment')->group(function () {
        Route::get('/', 'index')->name('registrar.assessment.index');
        Route::get('/show/{id}', 'show')->name('registrar.assessment.show');
        Route::post('/assess/{id}', 'store')->name('registrar.assessment.store');
    });

    // Accounting
    Route::controller(SemestralFeeController::class)->prefix('semestral-fee')->group(function () {
        Route::get('/', 'index')->name('semfee.index');
        Route::get('/create/{course}/{year}/{sem}', 'create')->name('semfee.create');
        Route::post('/store', 'store')->name('semfee.store');
        Route::get('/edit/{id}', 'edit')->name('semfee.edit');
        Route::put('/update/{id}', 'update')->name('semfee.update');
        Route::delete('/delete/{id}', 'delete')->name('semfee.delete');
        Route::get('/show/{id}', 'show')->name('semfee.show');
        Route::get('/fees', 'fees')->name('semfee.fees');
        Route::get('/fees/{course}/{year}/{sem}', 'goToFees')->name('semfee.show.fees');
        Route::get('/print/{course}/{year}/{sem}', 'print')->name('semfee.print');
        Route::get('/dowload/{course}/{year}/{sem}', 'download')->name('semfee.download');
    });
    // Assessment
    Route::controller(AssessmentController::class)->prefix('/course/assessment')->group(function () {
        Route::get('/', 'index')->name('assessment.index');
        Route::get('/show', 'show')->name('assessment.show');
    });
    Route::controller(EnrolleeAssessmentController::class)->prefix('/enrollee/assessment')->group(function () {
        Route::get('/', 'index')->name('enrollee.index');
        Route::get('/show/{id}', 'show')->name('enrollee.show');
    });
    // Payment
    Route::controller(PaymentsController::class)->prefix('/enrollee/payment')->group(function () {
      Route::get('/{id}', 'index')->name('payment.index');
    });
    //Handles Discounts
    Route::controller(DiscountController::class)->prefix('discounts')->group(function() {
        Route::get('/', 'index')->name('discount.index');
        Route::get('/create', 'create')->name('discount.create');
        Route::post('/store', 'store')->name('discount.store');
        Route::get('/edit/{id}', 'edit')->name('discount.edit');
        Route::delete('/delete/{id}', 'destroy')->name('discount.delete');
        Route::put('/update/{id}', 'update')->name('discount.update');
    });
    //Handles Student Discounts
    Route::controller(StudentDiscountController::class)->prefix('/enrollee/discounts')->group(function () {
      Route::post('/add-discount/{id}', 'addDiscount')->name('stdDiscount.addDiscount');
      Route::delete('/delete-discount/{id}', 'deleteDiscount')->name('stdDiscount.deleteDiscount');
    });
    // Downpayment
    Route::controller(DownpaymentController::class)->prefix('/downpayments')->group(function () {
      Route::get('/', 'index')->name('downpayment.index');
      Route::get('/create', 'create')->name('downpayment.create');
      Route::post('/store', 'store')->name('downpayment.store');
      Route::get('/edit/{id}', 'edit')->name('downpayment.edit');
      Route::put('/update/{id}', 'update')->name('downpayment.update');
      Route::delete('/delete/{id}', 'delete')->name('downpayment.delete');
    });
    // Payment
    Route::controller(PaymentController::class)->prefix('/payment')->group(function(){
      Route::post('/{id}', 'pay')->name('payment.pay');
    });
    
    Route::get('/user-management', [App\Http\Controllers\UserController::class, 'index'])->name('user.index');
    Route::get('/user-management/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create');
    Route::post('/user-management/store', [App\Http\Controllers\UserController::class, 'store'])->name('user.store');
    Route::get('/roles-and-permission', [App\Http\Controllers\RolesPermissionController::class, 'index'])->name('roles.index');
    Route::get('/roles-and-permission/create', [App\Http\Controllers\RolesPermissionController::class, 'create'])->name('roles.create');
    Route::post('/roles-and-permission/store', [App\Http\Controllers\RolesPermissionController::class, 'store'])->name('roles.store');
});
