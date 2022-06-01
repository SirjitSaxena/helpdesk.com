<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\TeacherController;
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


Route::get('/', [HomeController::class, 'index']);

Route::get('/home', [HomeController::class, 'redirect'])->middleware('auth', 'verified');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/my_profile', [HomeController::class, 'my_profile']);

Route::get('/my_profile/edit/{id}', [HomeController::class, 'edit_my_profile'])->name('student.edit');

Route::get('/notice', [HomeController::class, 'notice']);
Route::get('/notice_admin', [AdminController::class, 'notice_admin']);
Route::get('/add_notice', [AdminController::class, 'add_notice']);
Route::post('/upload_notice', [AdminController::class, 'upload_notice']);
Route::get('/notice/download/{id}', [PDFController::class, 'download_notice'])->name('downloadnotice');
Route::get('/notice/delete/{id}', [PDFController::class, 'delete_notice'])->name('deletenotice');


Route::get('/query', [HomeController::class, 'query']);
Route::post('/upload_query', [HomeController::class, 'upload_query']);
Route::get('/query_admin', [AdminController::class, 'query_admin']);
Route::get('/query/delete/{id}', [HomeController::class, 'delete_query'])->name('deletequery');


Route::get('/timetable', [HomeController::class, 'timetable']);
Route::get('/timetable_admin', [AdminController::class, 'timetable_admin']);
Route::get('/add_timetable', [AdminController::class, 'add_timetable']);
Route::post('/upload_timetable', [AdminController::class, 'upload_timetable']);
Route::get('/timetable/download/{id}', [PDFController::class, 'download_timetable'])->name('downloadtimetable');
Route::get('/timetable/delete/{id}', [PDFController::class, 'delete_timetable'])->name('deletetimetable');
Route::get('/timetable/view/{id}', [PDFController::class, 'view_timetable'])->name('viewtimetable');


Route::get('/add_student', [AdminController::class, 'add_student']);
Route::post('/student_added', [AdminController::class, 'student_added']);
Route::post('/student_edited/{id}', [HomeController::class, 'my_profile_edited']);
Route::get('/check_teacher', [HomeController::class, 'check_teacher']);
Route::get('/add_teacher', [AdminController::class, 'add_teacher']);
Route::get('/add_course', [AdminController::class, 'add_course']);
Route::get('/add_subject', [AdminController::class, 'add_subject']);
Route::post('/teacher_added', [AdminController::class, 'teacher_added']);
Route::post('/teacher_edited/{id}', [HomeController::class, 'teacher_my_profile_edited']);
Route::get('/teacher_my_profile/edit/{id}', [HomeController::class, 'edit_teacher_my_profile'])->name('teacher.edit');
Route::post('/course_added', [AdminController::class, 'course_added']);
Route::post('/subject_added', [AdminController::class, 'subject_added']);
Route::get('/course/delete/{id}', [AdminController::class, 'delete_course'])->name('deletecourse');
Route::get('/course/view/{id}', [AdminController::class, 'view_subject'])->name('viewsubject');
Route::get('/course/subject/delete/{id}', [AdminController::class, 'delete_subject'])->name('deletesubject');
Route::get('/take_attendance', [TeacherController::class, 'take_attendance']);
Route::get('/view_my_attendance', [HomeController::class, 'view_my_attendance']);
Route::post('/fetching_my_attendance', [HomeController::class, 'fetching_my_attendance']);
Route::get('/view_attendance_teacher', [TeacherController::class, 'view_attendance_teacher']);
Route::post('/fetching_attendance_teacher', [TeacherController::class, 'fetching_attendance_teacher']);
Route::post('/getSubject', [TeacherController::class, 'getSubject']);
Route::post('/attendance_taken', [TeacherController::class, 'attendance_taken']);
Route::post('/student_list_for_attendance',[TeacherController::class,'student_list_for_attendance']);
