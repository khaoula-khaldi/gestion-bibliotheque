<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\AuteurController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
   ->name('dashboard')
   ->middleware('auth');

Route::middleware('auth')->group(function () {
    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //livre 
    Route::get('/livres', [LivreController::class, 'index'])->name('livres.index');
    Route::get('/livres/create', [LivreController::class, 'create'])->name('livres.create');
    Route::post('/livres', [LivreController::class, 'store'])->name('livres.store');
    Route::get('/livres/{id}', [LivreController::class, 'show'])->name('livres.show');
    Route::get('/livres/{id}/edit', [LivreController::class, 'edit'])->name('livres.edit');
    Route::put('/livres/{id}', [LivreController::class, 'update'])->name('livres.update');
    Route::delete('/livres/{id}', [LivreController::class, 'destroy'])->name('livres.destroy');

    //auteur 
    Route::get('/auteurs', [AuteurController::class, 'index'])->name('Auteurs.index');
    Route::get('/auteurs/create', [AuteurController::class, 'create'])->name('Auteurs.create');
    Route::post('/auteurs', [AuteurController::class, 'store'])->name('Auteurs.store');
    Route::get('/auteurs/{id}', [AuteurController::class, 'show'])->name('Auteurs.show');
    Route::get('/auteurs/{id}/edit', [AuteurController::class, 'edit'])->name('Auteurs.edit');
    Route::put('/Auteurs/{id}', [AuteurController::class, 'update'])->name('Auteurs.update');
    Route::delete('/auteurs/{id}', [AuteurController::class, 'destroy'])->name('Auteurs.destroy');


});


Route::patch('/users/{user}/toggle', [UserController::class, 'toggleActive'])
    ->name('users.toggle')
    ->middleware('auth');




require __DIR__.'/auth.php';





