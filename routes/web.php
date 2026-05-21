<?php

use App\Http\Controllers\ApplicationDocumentController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('job-applications/archives', [JobApplicationController::class, 'archives'])
        ->name('job-applications.archives');
    Route::patch('job-applications/{job_application}/restore', [JobApplicationController::class, 'restore'])
        ->withTrashed()
        ->name('job-applications.restore');

    Route::resource('job-applications', JobApplicationController::class);
    Route::post('job-applications/{job_application}/documents', [ApplicationDocumentController::class, 'store'])
        ->name('job-applications.documents.store');
    Route::get('job-applications/{job_application}/documents/{document}/download', [ApplicationDocumentController::class, 'download'])
        ->name('job-applications.documents.download');
    Route::delete('job-applications/{job_application}/documents/{document}', [ApplicationDocumentController::class, 'destroy'])
        ->name('job-applications.documents.destroy');
    Route::resource('job-applications.interviews', InterviewController::class)
        ->except(['index', 'show']);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
