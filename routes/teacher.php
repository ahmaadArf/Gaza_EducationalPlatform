<?php

use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Students\StudentController;
use App\Http\Controllers\Dashboard\Teacher\Dashboard\QuizzController;
use App\Http\Controllers\Dashboard\Teacher\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\Teacher\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\Teacher\Dashboard\QuestionController;
use App\Http\Controllers\Dashboard\Teacher\Dashboard\TeacherDashboardController;
use App\Http\Controllers\Dashboard\Teacher\Dashboard\OnlineZoomClassesController;


Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:teacher'])->group(function () {

    Route::prefix('/teacher/dashboard')->name('teacher.dashboard.')->group(function(){

        Route::get('/',[TeacherDashboardController::class,'index'])->name('index');
        Route::get('sections',[TeacherDashboardController::class,'sections'])->name('sections');
        Route::get('students',[TeacherDashboardController::class,'students'])->name('students.index');
        Route::post('attendance',[TeacherDashboardController::class,'attendance'])->name('attendance');
        Route::get('attendance_report',[TeacherDashboardController::class,'attendanceReport'])->name('attendance.report');
        Route::post('attendance_report',[TeacherDashboardController::class,'attendanceSearch'])->name('attendance.search');
        Route::resource('subjects', SubjectController::class);
        Route::resource('quizzes', QuizzController::class);
        Route::resource('questions', QuestionController::class);
        Route::get('/Get_classrooms/{id}', [StudentController::class,'Get_classrooms']);
        Route::get('/Get_Sections/{id}', [StudentController::class,'Get_Sections']);
        Route::get('student_quizze/{id}',[QuizzController::class,'student_quizze'])->name('student.quizze');
        Route::resource('online_zoom_classes', OnlineZoomClassesController::class);
        Route::get('profile', [ProfileController::class,'index'])->name('profile.show');
        Route::post('profile/{id}',[ProfileController::class,'update'])->name('profile.update');

    });

});

