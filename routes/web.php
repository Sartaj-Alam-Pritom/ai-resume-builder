<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\CoverLetterController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\AnalyticsController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Dashboard (Custom)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'create'])
        ->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store']);

    Route::get('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])
        ->name('register');
    Route::post('/register', [App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);
});

// Password Reset Routes
Route::get('/forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'create'])
    ->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\Auth\PasswordResetLinkController::class, 'store'])
    ->name('password.email');
Route::get('/reset-password/{token}', [App\Http\Controllers\Auth\NewPasswordController::class, 'create'])
    ->name('password.reset');
Route::post('/reset-password', [App\Http\Controllers\Auth\NewPasswordController::class, 'store'])
    ->name('password.update');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resume Builder
    Route::get('/resume-builder', [ResumeController::class, 'show'])->name('resume.builder');
    Route::post('/resume/optimize', [ResumeController::class, 'optimizeResume'])->name('resume.optimize');

    // Cover Letter Generator
    Route::get('/cover-letter-generator', [CoverLetterController::class, 'show'])->name('cover.letter.generator');
    Route::post('/cover-letter/generate', [CoverLetterController::class, 'generateCoverLetter'])->name('cover.letter.generate');

    // Interview Simulation
    Route::get('/interview-simulation', [InterviewController::class, 'simulateInterview'])->name('interview.simulation');
    Route::post('/save-interview-response', [InterviewController::class, 'saveResponse'])->name('save.interview.response');

    // Analytics Dashboard
    Route::get('/analytics-dashboard', [AnalyticsController::class, 'dashboard'])->name('analytics.dashboard');
    Route::get('/export-analytics', [AnalyticsController::class, 'export'])->name('export.analytics');
});

require __DIR__.'/auth.php';