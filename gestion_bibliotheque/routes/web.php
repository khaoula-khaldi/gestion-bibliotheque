<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LivreController;

Route::get('/', function () {
    return view('welcome');
});

//livres
Route::get('/livres', [LivreController::class, 'index'])->name('livres.index'); 
Route::get('/livres/create', [LivreController::class, 'create'])->name('livres.create');
Route::post('/livres', [LivreController::class, 'store'])->name('livres.store');
Route::delete('/livres/{id}', [LivreController::class, 'destroy'])->name('livres.destroy');
Route::get('/livres/{id}/edit', [LivreController::class, 'edit'])->name('livres.edit');
Route::put('/livres/{id}', [LivreController::class, 'update'])->name('livres.update');
Route::get('/livres/{id}', [LivreController::class, 'show'])->name('livres.show');
