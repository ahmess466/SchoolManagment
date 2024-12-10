<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ParentMiddleware;
use App\Http\Middleware\StudentMiddleware;
use App\Http\Middleware\TeacherMiddleware;
use Illuminate\Support\Facades\Route;
use PhpParser\Builder\ClassConst;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[AuthController::class,'login']);
Route::post('login',[AuthController::class,'Authlogin']);
Route::get('logout',[AuthController::class,'logout']);
Route::get('forgot-password',[AuthController::class,'forgotpassword']);
Route::post('forgot-password',[AuthController::class,'PostForgotPassword'])->name('forget');













Route::group(['middleware'=>'admin'],function(){
    Route::get('admin/dashboard',[DashboardController::class,'dashboard']);

    Route::get('admin/admin',[AdminController::class , 'list'])->name('admin.list');
    Route::get('admin/admin/add',[AdminController::class , 'add']);
    Route::post('admin/admin/add',[AdminController::class,'insert'])->name('admin.insert');
    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.user.edit');
    Route::put('admin/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.user.update');
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.user.delete');
    //student Url
    Route::get('admin/student',[StudentController::class , 'list'])->name('admin.student.list');
    Route::get('admin/student/add',[StudentController::class , 'add'])->name('admin.student.add');
    Route::post('admin/student/add',[StudentController::class,'insert'])->name('admin.student.insert');
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit'])->name('admin.student.edit');
    Route::put('admin/student/edit/{id}', [StudentController::class, 'update'])->name('admin.student.update');
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete'])->name('admin.student.delete');
    //Parent Url
    Route::get('admin/parent',[ParentController::class , 'list'])->name('admin.parent.list');
    Route::get('admin/parent/add',[ParentController::class , 'add'])->name('admin.parent.add');
    Route::post('admin/parent/add',[ParentController::class,'insert'])->name('admin.parent.insert');
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit'])->name('admin.parent.edit');
    Route::put('admin/parent/edit/{id}', [ParentController::class, 'update'])->name('admin.parent.update');
    Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete'])->name('admin.parent.delete');
    Route::get('admin/parent/student/{id}', [ParentController::class, 'myStudent'])->name('admin.parent.student');
    Route::get('admin/parent/assign_student_parent/{student_id}/{parent_id}', [ParentController::class, 'AssignStudentParent']);
    Route::get('admin/parent/assign_student_parent_delete/{student_id}/', [ParentController::class, 'AssignStudentParentDelete']);
    //Teacher Url
    Route::get('admin/teacher',[TeacherController::class , 'list'])->name('admin.teacher.list');
    Route::get('admin/teacher/add',[TeacherController::class , 'add'])->name('admin.teacher.add');
    Route::post('admin/teacher/add',[TeacherController::class,'insert'])->name('admin.teacher.insert');
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit'])->name('admin.teacher.edit');
    Route::put('admin/teacher/edit/{id}', [TeacherController::class, 'update'])->name('admin.teacher.update');
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete'])->name('admin.teacher.delete');
    //class Url
    Route::get('admin/class',[ClassController::class , 'list'])->name('admin.class');
    Route::get('admin/class/add',[ClassController::class , 'add'])->name('admin.add.class');
    Route::post('admin/class/insert',[ClassController::class,'insert'])->name('admin.insert.class');
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit'])->name('admin.class.edit');
    Route::put('admin/class/update/{id}', [ClassController::class, 'update'])->name('admin.class.update');
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete'])->name('admin.class.delete') ;

    //subject Url
    Route::get('admin/subject',[SubjectController::class , 'list'])->name('admin.subject');
    Route::get('admin/subject/add',[SubjectController::class , 'add'])->name('admin.add.subject');
    Route::post('admin/subject/insert',[SubjectController::class,'insert'])->name('admin.insert.subject');
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit'])->name('admin.subject.edit');
    Route::put('admin/subject/update/{id}', [SubjectController::class, 'update'])->name('admin.subject.update');
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete'])->name('admin.subject.delete') ;


    //Assign Subjects
    Route::get('admin/assign',[ClassSubjectController::class , 'list'])->name('admin.assign');
    Route::get('admin/assign/add',[ClassSubjectController::class , 'add'])->name('admin.add.assign');
    Route::post('admin/assign/insert',[ClassSubjectController::class,'insert'])->name('admin.insert.assign');
    Route::get('admin/assign/edit/{id}', [ClassSubjectController::class, 'edit'])->name('admin.assign.edit');
    Route::put('admin/assign/update/{id}', [ClassSubjectController::class, 'update'])->name('admin.assign.update');
    Route::get('admin/assign/delete/{id}', [ClassSubjectController::class, 'delete'])->name('admin.assign.delete') ;

    Route::get('admin/assign/edit_single/{id}', [ClassSubjectController::class, 'editSingle'])->name('admin.assign.edit.single');
    Route::put('admin/assign/update_single/{id}', [ClassSubjectController::class, 'updateSingle'])->name('admin.assign.update.single');


    //change Password

    Route::get('admin/change_password',[UserController::class , 'changePassword'])->name('admin.change.password');
    Route::post('admin/change/password',[UserController::class,'updatePassword'])->name('admin.update.password');





});

Route::group(['middleware'=>'teacher'],function(){
    Route::get('teacher/dashboard',[DashboardController::class,'dashboard']);

    Route::get('teacher/change_password',[UserController::class , 'changePassword'])->name('teacher.change.password');
    Route::post('teacher/change/password',[UserController::class,'updatePassword'])->name('teacher.update.password');


});
Route::group(['middleware'=>'parent'],function(){
    Route::get('parent/dashboard',[DashboardController::class,'dashboard']);
    Route::get('parent/change_password',[UserController::class , 'changePassword'])->name('parent.change.password');
    Route::post('parent/change/password',[UserController::class,'updatePassword'])->name('parent.update.password');


});
Route::group(['middleware'=>'student'],function(){
    Route::get('student/dashboard',[DashboardController::class,'dashboard']);
    Route::get('student/change_password',[UserController::class , 'changePassword'])->name('student.change.password');
    Route::post('stu/change/password',[UserController::class,'updatePassword'])->name('student.update.password');


});

