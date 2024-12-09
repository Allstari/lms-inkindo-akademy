<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MeetingScheduleController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\InstructorController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Instructor\CourseController as InstructorCourseController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [ContactController::class, 'index'])->name("contact");

Route::get('/course', [CourseController::class, 'index'])->name('course.index');
Route::get('/course/{course}', [CourseController::class, 'show'])->name('course.show');
Route::post('/course', [CourseController::class, 'store'])->name('course.store');
Route::get('/course/{course}/read/{topic}', [CourseController::class, 'read'])->name('course.read');
Route::post('/course/{course}/{topic}/read/done', [CourseController::class, 'completed'])->name('course.done');
Route::post('/course/{course}/{topic}/read/quiz', [CourseController::class, 'submit'])->name('course.submit');
Route::delete('/course/{course}/{topic}/read/quiz', [CourseController::class, 'destroy'])->name('course.destroy');
Route::post('/update-exitcount', [CourseController::class, 'updateExitCount'])->name('course.exitcount');


Route::prefix('dashboard')->name('dashboard.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::middleware(['role:participant|instructor'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::name('admin.')->middleware(['role:author'])->group(function () {
        Route::resource('/participant', ParticipantController::class)->except('show');
        Route::resource('/instructor', controller: InstructorController::class)->except('show');
        Route::resource('/course', AdminCourseController::class)->except('show');
        // Route::resource('/course', AdminCourseController::class)->except('show');
        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::post('/setting', [SettingController::class, 'store'])->name('setting.store');
    });

    Route::middleware(['role:author|instructor'])->group(function () {
        Route::resource('/material', MaterialController::class)->except('show');
        Route::get('/material/{course}/create', [MaterialController::class, 'createWithCourse'])->name('course.createWithCourse');
        Route::resource('/assignment', AssignmentController::class)->except('show');
        Route::resource('/quiz', QuizController::class)->except('show');
        Route::get('/enrollment', [EnrollmentController::class, 'index'])->name('enrollment.index');
        Route::put('/enrollment/{enrollment}', [EnrollmentController::class, 'update'])->name('enrollment.update');
        Route::put('/enrollment/{enrollment}', [EnrollmentController::class, 'update'])->name('enrollment.update');
        Route::post('/enrollment', [EnrollmentController::class, 'updateAll'])->name('enrollment.updateAll');
        Route::delete('/enrollment/{enrollment}', [EnrollmentController::class, 'destroy'])->name('enrollment.destroy');
        Route::get('/instructor/courses', [InstructorCourseController::class, 'index'])->name('courses.index');
        Route::resource('/question', QuestionController::class);
        Route::get('/question/{quiz}/create', [QuestionController::class, 'createWithQuiz'])->name('question.createWithQuiz');
    });

    Route::name('instructor.')->middleware(['role:instructor'])->group(function () {
        Route::get('/instructor/course', [InstructorCourseController::class, 'index'])->name('course.index');
    });
});

Route::get('meetings', [MeetingController::class, 'index']);
Route::post('meetings', [MeetingController::class, 'store']);
Route::get('meetings/{id}', [MeetingController::class, 'show']);

// Route untuk menambah MeetingSchedule
Route::post('/meeting-schedules', [MeetingScheduleController::class, 'store']);

// Route untuk melihat detail MeetingSchedule
Route::get('/meeting-schedules/{id}', [MeetingScheduleController::class, 'show']);

// Route untuk mengupdate MeetingSchedule
Route::put('/meeting-schedules/{id}', [MeetingScheduleController::class, 'update']);

// Route untuk menghapus MeetingSchedule
Route::delete('/meeting-schedules/{id}', [MeetingScheduleController::class, 'destroy']);

///

// Menampilkan semua meeting beserta kursus yang terkait
Route::resource('meetings', MeetingController::class);

Route::resource('meeting_schedule', MeetingController::class);
// Menampilkan jadwal meeting terkait
Route::get('meetings/{meetingId}/schedules', [MeetingController::class, 'schedules']);

// Menambahkan jadwal meeting untuk sebuah meeting
Route::post('meetings/{meetingId}/add-schedule', [MeetingController::class, 'addSchedule']);


require __DIR__ . '/auth.php';
