<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DhenyController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\ParticipantController;
// use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dheny', [DhenyController::class, 'index'])->name("view.dheny");
Route::get('/contact', [ContactController::class, 'index'])->name("contact");

Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/{course}', [CourseController::class, 'show'])->name('course.show');
Route::post('/course', [CourseController::class, 'store'])->name('course.store');
Route::get('/course/{course}/read/{topic}', [CourseController::class, 'read'])->name('course.read');
Route::post('/course/{course}/read/done', [CourseController::class, 'completed'])->name('course.done');

// Admin dashboard routes with authentication
Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Assignment Routes - No need to declare this twice
    Route::resource('/assignment', AssignmentController::class)->except('show');

    // Profile Routes
    Route::middleware(['role:participant|instructor'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Admin routes, protected by the 'author' role
    Route::name('admin.')->middleware(['role:author'])->group(function () {
        Route::resource('/participant', ParticipantController::class)->except('show');
        Route::resource('/instructor', InstructorController::class)->except('show');
        Route::resource('/course', AdminCourseController::class)->except('show');
        Route::resource('/material', MaterialController::class)->except('show');
        Route::get('/material/{course}/create', [MaterialController::class, 'createWithCourse'])->name('course.createWithCourse');
        // Route::get('/enrollment', EnrollmentController::class)->except('index');
    });
});

require __DIR__ . '/auth.php';
