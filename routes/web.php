<?php

use App\Http\Controllers\UserControler;
use Illuminate\Support\Facades\Route;
use App\Models\user;


Route::get('/', function () {
    return view('welcome');
});


Route::get("/",[UserControler::class, 'index'])->name("index.user");

// Route pour afficher le formulaire d'inscription
Route::get('/register', [UserControler::class, 'add_user'])->name('register');

// Route pour traiter le formulaire d'inscription
Route::post('/register', [UserControler::class, 'store'])->name('store.user');

// Route pour afficher le formulaire de connexion
Route::get('/login', function () {
    return view('login');
})->name('login');

// Route pour traiter le formulaire de connexion
Route::post('/login', [UserControler::class, 'login'])->name('login.user');

