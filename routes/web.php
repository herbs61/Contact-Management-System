<?php

use App\Http\Controllers\Contact;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


});


Route::get('/contacts',[ContactController::class, 'index'])->name('contact.index');

Route::post('/contacts/create',[ContactController::class, 'store'])->name('contact.create');

Route::get('/contacts/{id}/edit', [ContactController::class, 'edit'])->name('contacts.edit');

Route::put('/contacts/{id}', [ContactController::class, 'update'])->name('contacts.update');

Route::put('/contacts/{id}/delete', [ContactController::class, 'softDelete'])->name('contacts.destroy');

Route::get('/contacts/search', [ContactController::class, 'search'])->name('contacts.search');


require __DIR__.'/auth.php';
