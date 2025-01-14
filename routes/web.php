<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\GradeController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\ClassroomController;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Teacher\TeacherController;



require __DIR__.'/auth.php';
Route::get('/', [DashboardController::class,'selection'])->middleware('guest');
Route::get('/login/{type}',[DashboardController::class,'loginForm'])->middleware('guest')->name('login.show');

Route::prefix(LaravelLocalization::setLocale())->middleware(['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::prefix('dashboard')->middleware('auth:web')->name('dashboard.')->group(function () {
    Route::resource('grades', GradeController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::post('Filter_Classes', [ClassroomController::class,'Filter_Classes'])->name('classrooms.filter');
    Route::post('delete_all', [ClassroomController::class,'delete_all'])->name('classrooms.delete_all');
    Route::resource('sections', SectionController::class);
    Route::get('/classes/{id}', [SectionController::class,'getclasses'])->name('sections.getclasses');
    Route::resource('teachers', TeacherController::class);

    });

});
//test name
