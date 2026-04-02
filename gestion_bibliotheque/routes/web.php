<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivreController;
use App\Http\Controllers\AuteurController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\EmpruntController;


Route::get('/', function () {
    return view('welcome');
});

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

    //subscription
    Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');

    //dashbord admin 
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])
    ->middleware(['auth'])
    ->name('admin.dashboard');

    //emprunt
    Route::get('/emprunts', [EmpruntController::class, 'index'])->name('emprunts.index');
    Route::get('/emprunts/create', [EmpruntController::class, 'create'])->name('emprunts.create');
    Route::post('/emprunts', [EmpruntController::class, 'store'])->name('emprunts.store');
    Route::get('/emprunts/{emprunt}', [EmpruntController::class, 'show'])->name('emprunts.show');
    Route::post('/emprunts/{id}/retour', [EmpruntController::class, 'retour'])->name('emprunts.retour');
    Route::delete('/emprunts/{emprunt}', [EmpruntController::class, 'destroy'])->name('emprunts.destroy');
});





require __DIR__.'/auth.php';





