<?php

use App\Http\Controllers\ClassSectionController;
use App\Http\Controllers\ClassTeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\SubjectTeacherController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Teacher\TeacherController as Teacher;
use App\Http\Controllers\Student\StudentController as Student;
use App\Http\Controllers\TeacherSalaryController;
use App\Http\Controllers\SalaryDetailController;
use App\Http\Controllers\StudentAttendanceController;
use App\Http\Controllers\StudentFeeController;
use App\Http\Controllers\StudentFeeDetailController;
use App\Http\Controllers\TeacherAttendanceController;
use App\Models\ClassSection;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentResultController;

use App\Http\Controllers\SettingController;
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

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('settings', [SettingController::class, 'index']);
Route::post('change_password', [SettingController::class, 'changePassword']);



Route::middleware(['auth', 'checkAdmin'])->group(function () {


    Route::get('subjects', [App\Http\Controllers\SubjectController::class, 'index'])->name('subject');
    Route::get('show_course_list', [SubjectController::class,'show']);
    Route::get('add_subjects',[SubjectController::class,'create'])->name('add_subjects');
    Route::post('save_new_course',[SubjectController::class,'store']);
    Route::post('delete_subject',[SubjectController::class,'destroy']);
    Route::get('edit_subjects',[SubjectController::class, 'edit']);
    Route::post('update_subjects',[SubjectController::class, 'update']);


    Route::get('class_sections', [ClassSectionController::class, 'index'])->name('class_sections');
    Route::get('show_class_section', [ClassSectionController::class, 'show']);
    Route::get('add_class_sections', [ClassSectionController::class, 'create'])->name('add_class_sections');
    Route::post('add_class_section',[ClassSectionController::class, 'store']);
    Route::post('delete_class_section', [ClassSectionController::class,'destroy']);
    Route::get('edit_class_section',[ClassSectionController::class ,'edit']);
    Route::post('update_class_section',[ClassSectionController::class ,'update']);


    Route::get('students',[StudentController::class ,'index'])->name('students');
    Route::get('show_students',[StudentController::class, 'show']);
    Route::get('add_students',[StudentController::class ,'create'])->name('add_students');
    Route::post('save_new_student',[StudentController::class ,'store'])->name('save_new_student');
    Route::post('delete_student',[StudentController::class, 'destroy'])->name('delete_student');
    Route::get('edit_student',[StudentController::class, 'edit'])->name('edit_student');
    Route::post('update_student',[StudentController::class, 'update']);
    Route::get('student_card',[StudentController::class, 'student_card']);
    Route::get('struck_off_student_list', [StudentController::class, 'struck_off_student']);
    Route::get('leave_student_list', [StudentController::class, 'leave_student']);

    Route::get('search_class_base_student_list', [StudentController::class, 'class_base_Student']);
    Route::get('class_base_student_list', [StudentController::class, 'class_base_Student']);

    Route::get('teachers',[App\Http\Controllers\TeacherController::class,'index'])->name('teacher');
    Route::get('show_teachers', [TeacherController::class, 'show']);
    Route::get('add_teacher',[TeacherController::class,'create']);
    Route::get('edit_teacher',[TeacherController::class,'edit']);
    Route::post('update_teacher_profile', [TeacherController::class , 'update']);
    Route::get('teacher_card', [TeacherController::class, 'teacher_card']);
    Route::post('save_new_teacher',[TeacherController::class,'store']);
    Route::post('delete_teacher',[TeacherController::class,'destroy']);


    Route::get('class_teachers', [ClassTeacherController::class, 'index'])->name('class_teachers');
    Route::get('add_class_teacher', [ClassTeacherController::class,'create']);
    Route::get('show_class_teachers', [ClassTeacherController::class,'show']);
    Route::post('save_class_teacher',[ClassTeacherController::class,'store']);
    Route::get('edit_class_teacher', [ClassTeacherController::class, 'edit']);
    Route::post('update_class_teacher', [ClassTeacherController::class, 'update']);
    Route::post('delete_class_teacher', [ClassTeacherController::class, 'destroy']);



    Route::get('subject_teachers',[SubjectTeacherController::class, 'index'])->name('subject_teachers');
    Route::get('show_subject_teachers', [SubjectTeacherController::class, 'show']);
    Route::get('add_subject_teacher', [SubjectTeacherController::class,'create']);
    Route::post('save_subject_teacher', [SubjectTeacherController::class, 'store']);
    Route::get('edit_subject_teacher', [SubjectTeacherController::class, 'edit']);
    Route::post('update_subject_teacher', [SubjectTeacherController::class, 'update']);
    Route::post('delete_subject_teacher', [SubjectTeacherController::class, 'destroy']);


    Route::get('teacher_salaries', [TeacherSalaryController::class, 'index']);
    Route::get('show_teacher_salaries', [TeacherSalaryController::class, 'show']);
    Route::post('save_teacher_salary', [TeacherSalaryController::class, 'store']);
    Route::get('edit_teacher_salary', [TeacherSalaryController::class, 'edit']);
    Route::post('update_teacher_salary',[TeacherSalaryController::class, 'update']);
    Route::post('delete_teacher_salary', [TeacherSalaryController::class, 'destroy']);
    

    Route::get('salary_detail', [SalaryDetailController::class,'index']);
    Route::get('show_salary_detail', [SalaryDetailController::class,'show']);
    Route::post('save_salary_detail', [SalaryDetailController::class, 'store']);
    Route::get('edit_salary_detail', [SalaryDetailController::class, 'edit']);
    Route::post('update_salary_detail', [SalaryDetailController::class, 'update']);
    Route::post('delete_salary_detail',[SalaryDetailController::class, 'destroy']);


    Route::get('teacher_attendance',[TeacherAttendanceController::class,'index']);
    Route::get('show_teacher_attendance', [TeacherAttendanceController::class, 'show']);
    Route::get('mark_teacher_attendance', [TeacherAttendanceController::class, 'create']);
    Route::post('mark_teacher_attendance', [TeacherAttendanceController::class, 'store']);
    Route::get('today_teacher_attendance_list', [TeacherAttendanceController::class, 'today_attendance']);
    Route::post('mark_all_teacher_attendance', [TeacherAttendanceController::class, 'mark_all_teacher_attendance']);

    Route::get('attendance_detail', [TeacherAttendanceController::class,'detail']);
    Route::get('show_attendance_detail', [TeacherAttendanceController::class, 'show_detail']);
    Route::get('edit_teacher_attendance', [TeacherAttendanceController::class, 'edit']);
    Route::post('update_teacher_attendance', [TeacherAttendanceController::class, 'update']);



    Route::get('student_attendances', [StudentAttendanceController::class, 'index']);
    Route::get('show_class_base_student',[StudentAttendanceController::class, 'show']);
    Route::get('student_attendance_detail',[StudentAttendanceController::class,'detail']);
    Route::get('show_student_attendance_detail',[StudentAttendanceController::class, 'show_detail']);
    Route::post('mark_student_attendance_by_admin',[StudentAttendanceController::class, 'store']);
    Route::get('edit_student_attendance',[StudentAttendanceController::class, 'edit']);
    Route::post('update_student_attendance',[StudentAttendanceController::class, 'update']);
    Route::post('delete_student_attendance', [StudentAttendanceController::class, 'destroy']);



    Route::get('student_fee', [StudentFeeController::class, 'index']);
    Route::get('show_student_fee', [StudentFeeController::class, 'show']);
    Route::post('add_student_fee', [StudentFeeController::class, 'store']);
    Route::get('edit_student_fee', [StudentFeeController::class, 'edit']);
    Route::post('update_student_fee', [StudentFeeController::class, 'update']);
    Route::post('remove_student_fee', [StudentFeeController::class, 'destroy']);
    Route::get('print_fee_voucher', [StudentFeeDetailController::class,'fee_voucher']);


    Route::get('student_fee_detail', [StudentFeeDetailController::class, 'index']);
    Route::get('show_student_fee_detail', [StudentFeeDetailController::class, 'show']);
    Route::get('edit_student_fee_detail', [StudentFeeDetailController::class, 'edit']);
    Route::post('update_student_fee_detail', [StudentFeeDetailController::class, 'update']);


    Route::get('class_results', [StudentResultController::class, 'index']);
    Route::get('show_results', [StudentResultController::class, 'show']);
    Route::post('add_result', [StudentResultController::class, 'store']);
    Route::get('edit_result', [StudentResultController::class, 'edit']);
    Route::post('update_result', [StudentResultController::class, 'update']);
    Route::post('remove_result', [StudentResultController::class, 'destroy']);
});

Route::group(['middleware' => ['auth','checkStudent']], function () {
    Route::get('student_fee_voucher', [Student::class, 'fee_voucher']);
    Route::get('print_student_fee_voucher', [Student::class,'print_fee_voucher']);
    Route::get('student_attendance', [Student::class, 'attendance']);
    Route::get('student_result', [Student::class, 'student_result']);
});


Route::group(['middleware' => ['auth','checkTeacher']], function () {
   Route::get('subject_classes', [Teacher::class, 'subjects']); 
   Route::get('salary', [Teacher::class, 'salary']);
   Route::get('attendance',[Teacher::class, 'attendance']);
   Route::get('check_absent_today',[Teacher::class, 'check_absent']);
   Route::get('class_attendance', [Teacher::class, 'class_attendance']);
   Route::post('mark_student_attendance',[Teacher::class, 'mark_attendance']);
   Route::get('class_result', [Teacher::class, 'class_result']);
});