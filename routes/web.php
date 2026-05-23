<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\BookingNoteController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return redirect('/dashboard/calendar');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {

    Route::resource('users', UserController::class);

});

Route::resource('clients', ClientController::class)->middleware(['auth']);

Route::resource('bookings', BookingController::class)->middleware(['auth']);

Route::post('/bookings/{booking}/notes', [BookingNoteController::class, 'store'])
    ->middleware(['auth'])
    ->name('bookings.notes.store');

Route::delete('/notes/{note}', [BookingNoteController::class, 'destroy'])
    ->middleware(['auth'])
    ->name('notes.destroy');

Route::get('/dashboard/calendar', [CalendarController::class, 'index'])
    ->middleware(['auth'])
    ->name('calendar.index');

Route::get(
    '/bookings/{booking}/sidebar',
    [BookingController::class, 'sidebar']
)->name('bookings.sidebar');

require __DIR__.'/auth.php';
