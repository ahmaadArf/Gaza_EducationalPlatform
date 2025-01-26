<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\GradeController;
use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\ClassroomController;
use App\Http\Controllers\Dashboard\DashboardController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Dashboard\Teacher\TeacherController;
use App\Http\Controllers\Dashboard\Students\StudentController;
use App\Http\Controllers\Dashboard\Students\Fees\FeesController;
use App\Http\Controllers\Dashboard\Students\GraduatedController;
use App\Http\Controllers\Dashboard\Students\PromotionController;
use App\Http\Controllers\Dashboard\Students\AttendanceController;
use App\Http\Controllers\Dashboard\Students\Fees\PaymentController;
use App\Http\Controllers\Dashboard\Students\Fees\FeesInvoicesController;
use App\Http\Controllers\Dashboard\Students\Fees\ProcessingFeeController;
use App\Http\Controllers\Dashboard\Students\Fees\ReceiptStudentController;



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
    Route::resource('students', StudentController::class);
    Route::get('/Get_classrooms/{id}', [StudentController::class,'Get_classrooms']);
    Route::get('/Get_Sections/{id}', [StudentController::class,'Get_Sections']);
    Route::post('Upload_attachment', [StudentController::class,'Upload_attachment'])->name('students.Upload_attachment');
    Route::get('Download_attachment/{studentsname}/{filename}',[StudentController::class,'Download_attachment'])->name('students.Download_attachment');
    Route::post('Delete_attachment', [StudentController::class,'Delete_attachment'])->name('students.Delete_attachment');
    Route::resource('promotions', PromotionController::class);
    Route::delete('promotion/delete-all',[PromotionController::class,'destroyAllStudents'])->name('promotions.destroyAllStudents');
    Route::resource('graduated', GraduatedController::class);
    Route::resource('fees', FeesController::class);
    Route::resource('fees_Invoices', FeesInvoicesController::class);
    Route::resource('receipt_students', ReceiptStudentController::class);
    Route::resource('processingFee', ProcessingFeeController::class);
    Route::resource('payment_students', PaymentController::class);
    Route::resource('attendance', AttendanceController::class);
    Route::resource('subjects', SubjectController::class);

    });

});
Route::get('ar/dashboard/add_parent', function () {
    return view('livewire.show_Form');
})->middleware('auth')->name('add_parent_ar');
Route::get('en/dashboard/add_parent', function () {
    return view('livewire.show_Form');
})->middleware('auth')->name('add_parent_en');

