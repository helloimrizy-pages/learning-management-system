<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\SubjectController as TeacherSubjectController;
use App\Http\Controllers\Teacher\TaskController as TeacherTaskController;
use App\Http\Controllers\Teacher\SolutionController as TeacherSolutionController;
use App\Http\Controllers\Student\SubjectController as StudentSubjectController;
use App\Http\Controllers\Student\TaskController as StudentTaskController;

Route::get('/', function () {
    return view('welcome');
});

Route::view('/contact', 'contact');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return auth()->user()->role == 'teacher' ? redirect('/teacher/subjects') : redirect('/student/subjects');
    })->name('dashboard');

    Route::prefix('teacher')->middleware('teacher')->group(function () {
        Route::resource('subjects', TeacherSubjectController::class);
        Route::get('subjects/{subject}/tasks/create', [TeacherTaskController::class, 'create'])->name('tasks.create');
        Route::post('subjects/{subject}/tasks', [TeacherTaskController::class, 'store'])->name('tasks.store');
        Route::get('tasks/{task}', [TeacherTaskController::class, 'show'])->name('tasks.show');
        Route::get('tasks/{task}/edit', [TeacherTaskController::class, 'edit'])->name('tasks.edit');
        Route::put('tasks/{task}', [TeacherTaskController::class, 'update'])->name('tasks.update');

        Route::get('solutions/{solution}/edit', [TeacherSolutionController::class, 'edit'])->name('solutions.edit');
        Route::put('solutions/{solution}', [TeacherSolutionController::class, 'update'])->name('solutions.update');
    });

    Route::prefix('student')->middleware('student')->group(function () {
        Route::resource('subjects', StudentSubjectController::class)->except(['edit', 'update']);
        Route::get('tasks/{task}', [StudentTaskController::class, 'show'])->name('student.tasks.show');
        Route::post('tasks/{task}/submit', [StudentTaskController::class, 'store'])->name('student.tasks.submit');
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

require __DIR__.'/auth.php';
