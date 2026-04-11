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
use App\Http\Controllers\AchatController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
   ->name('dashboard')
   ->middleware('auth');

Route::middleware(['auth'])->group(function () {
    
    // 1. Admin Group (Hadu khashom ikounou huma l-lowlin)
    Route::middleware(['admin','checkBanned'])->group(function () {
        Route::get('/livres/create', [LivreController::class, 'create'])->name('livres.create');
        Route::post('/livres', [LivreController::class, 'store'])->name('livres.store');
        Route::get('/livres/{id}/edit', [LivreController::class, 'edit'])->name('livres.edit');
        Route::put('/livres/{id}', [LivreController::class, 'update'])->name('livres.update');
        Route::get('/livres', [LivreController::class, 'index'])->name('livres.index');
        Route::delete('/livres/{id}', [LivreController::class, 'destroy'])->name('livres.destroy');
        Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
        //tout les abonnment 
        Route::get('/subscriptions', [SubscriptionController::class, 'index'])
            ->name('subscriptions.index');

        Route::get('/admin/emprunts', [EmpruntController::class, 'index'])->name('emprunts.index');
        Route::post('/emprunts/{id}/retour', [EmpruntController::class, 'retour'])->name('emprunts.retour');
        //bane inban user 
        Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
        Route::post('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle');

        //achats
        Route::get('/admin/achats', [AchatController::class, 'index'])->name('achats.index');

        //auteur 
        Route::get('/auteurs', [AuteurController::class, 'index'])->name('auteurs.index');
        Route::get('/auteurs/create', [AuteurController::class, 'create'])->name('auteurs.create');
        Route::post('/auteurs', [AuteurController::class, 'store'])->name('auteurs.store');
        Route::get('/auteurs/{id}', [AuteurController::class, 'show'])->name('auteurs.show');
        Route::get('/auteurs/{id}/edit', [AuteurController::class, 'edit'])->name('auteurs.edit');
        Route::put('/auteurs/{id}', [AuteurController::class, 'update'])->name('auteurs.update');
        Route::delete('/auteurs/{id}', [AuteurController::class, 'destroy'])->name('auteurs.destroy');
        });

    //Lecteur Routes

    //profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/livres/{id}', [LivreController::class, 'show'])->name('livres.show');
    Route::get('/catalogue', [LivreController::class, 'catalogue'])->name('livres.catalogue');

    Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscriptions.create');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');

    Route::get('/mes-emprunts', [EmpruntController::class, 'mesEmprunts'])->name('emprunts.mes_emprunts');
    Route::get('/emprunts/create', [EmpruntController::class, 'create'])->name('emprunts.create');
    Route::post('/emprunts', [EmpruntController::class, 'store'])->name('emprunts.store');


    Route::get('/mes-achats', [AchatController::class, 'mesAchats'])->name('achats.mes_achats');
    Route::post('/achats', [AchatController::class, 'store'])->name('achats.store');


});


require __DIR__.'/auth.php';




/*
Route::middleware('auth')->group(function () {

    //subscription
    // Route::get('/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    // Route::get('/subscriptions/create', [SubscriptionController::class, 'create'])->name('subscriptions.create');
    // Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');

    //dashbord admin 
    // Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])
    // ->middleware(['auth'])
    // ->name('admin.dashboard');

    //livre 
    // Route::get('/livres', [LivreController::class, 'index'])->name('livres.index');
    // Route::get('/livres/create', [LivreController::class, 'create'])->name('livres.create');
    // Route::post('/livres', [LivreController::class, 'store'])->name('livres.store');
    // Route::get('/livres/{id}', [LivreController::class, 'show'])->name('livres.show');
    // Route::get('/livres/{id}/edit', [LivreController::class, 'edit'])->name('livres.edit');
    // Route::put('/livres/{id}', [LivreController::class, 'update'])->name('livres.update');
    // Route::delete('/livres/{id}', [LivreController::class, 'destroy'])->name('livres.destroy');

    //auteur 
    // Route::get('/auteurs', [AuteurController::class, 'index'])->name('Auteurs.index');
    // Route::get('/auteurs/create', [AuteurController::class, 'create'])->name('Auteurs.create');
    // Route::post('/auteurs', [AuteurController::class, 'store'])->name('Auteurs.store');
    // Route::get('/auteurs/{id}', [AuteurController::class, 'show'])->name('Auteurs.show');
    // Route::get('/auteurs/{id}/edit', [AuteurController::class, 'edit'])->name('Auteurs.edit');
    // Route::put('/Auteurs/{id}', [AuteurController::class, 'update'])->name('Auteurs.update');
    // Route::delete('/auteurs/{id}', [AuteurController::class, 'destroy'])->name('Auteurs.destroy');


    //emprunt
    // Route::get('/emprunts', [EmpruntController::class, 'index'])->name('emprunts.index');
    // Route::get('/emprunts/create', [EmpruntController::class, 'create'])->name('emprunts.create');
    // Route::post('/emprunts', [EmpruntController::class, 'store'])->name('emprunts.store');
    // Route::get('/emprunts/{emprunt}', [EmpruntController::class, 'show'])->name('emprunts.show');
    // Route::post('/emprunts/{id}/retour', [EmpruntController::class, 'retour'])->name('emprunts.retour');
    // Route::delete('/emprunts/{emprunt}', [EmpruntController::class, 'destroy'])->name('emprunts.destroy');

    //achats
    // Route::get('/achat/create', [AchatController::class, 'create'])->name('achat.create');
    // Route::post('/achat/store', [AchatController::class, 'store'])->name('achat.store');
    // Route::get('/achats', [AchatController::class, 'index'])->name('achats.index');


});
*/









