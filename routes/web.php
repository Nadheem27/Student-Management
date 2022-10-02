<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MarksController;

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

Route::get('/', function() { return redirect('/student'); });

Route::group(['prefix' => 'student', 'as' => 'student.'], function() {
    Route::get('/', [StudentController::class, 'student'])->name('student');
    Route::get('/list', [StudentController::class, 'studentList'])->name('student-list');
    Route::get('/add', [StudentController::class, 'studentAdd'])->name('student-add');
    Route::post('/store', [StudentController::class, 'studentStore'])->name('student-store');
    Route::get('/edit/{id}', [StudentController::class, 'studentEdit'])->name('student-edit');
    Route::post('/update', [StudentController::class, 'studentUpdate'])->name('student-update');
    Route::post('/delete', [StudentController::class, 'studentDelete'])->name('student-delete');
});

Route::group(['prefix' => 'mark', 'as' => 'mark.'], function() {
    Route::get('/', [MarksController::class, 'mark'])->name('mark');
    Route::get('/list', [MarksController::class, 'markList'])->name('mark-list');
    Route::get('/add', [MarksController::class, 'markAdd'])->name('mark-add');
    Route::post('/store', [MarksController::class, 'markStore'])->name('mark-store');
    Route::get('/edit/{id}', [MarksController::class, 'markEdit'])->name('mark-edit');
    Route::post('/update', [MarksController::class, 'markUpdate'])->name('mark-update');
    Route::post('/delete', [MarksController::class, 'markDelete'])->name('mark-delete');
});
