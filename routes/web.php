<?php

use App\Http\Controllers\ApplicationController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\SelectGioiDan;
use App\Livewire\UserProfile;

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect()->route('login');
})->name('logout');

Route::get('/tra-cuu', function () {
    return view('tracking');
})->name('application.track');

Route::middleware('auth')->group(function () {
    Route::get('/', SelectGioiDan::class)->name('home');
    Route::get('/dang-ky', function () {
        return view('dang-ky');
    })->name('dang-ky');
    Route::get('/profile', UserProfile::class)->name('profile');
});

Route::get('/print/{application}', [ApplicationController::class, 'print'])->name('application.print');
