<?php

use App\Http\Controllers\ApplicationController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tra-cuu', function () {
    return view('tracking');
})->name('application.track');

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::post('/logout', function() {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/');
})->name('logout');

Route::get('/print/{application}', [ApplicationController::class, 'print'])->name('application.print');
