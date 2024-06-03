<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'doLogin'])->name('login');

    Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'doRegister'])->name('register');
});


// Routes protégées par auth middleware
Route::middleware('auth')->group(function () {
    // Les routes publiques
    Route::get('/',  [HomeController::class, 'index'])->name('home');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/ventes', [HomeController::class, 'ventes'])->name('ventes');
    Route::get('/ventes.init', [HomeController::class, 'ligneVente'])->name('ventes.init');
    Route::post('/ventes.next', [HomeController::class, 'venteNext'])->name('ventes.next');
    Route::post('/ventes.overview', [HomeController::class, 'overview'])->name('ventes.overview');
    Route::post('/ventes.confim', [HomeController::class, 'confirm'])->name('ventes.confirm');
    Route::get('/ventes.details/{id}', [HomeController::class, 'details'])->name('ventes.details');

    Route::get('/approvisionnements', [HomeController::class, 'approvisionnements'])->name('approvisionnements');

    Route::get('/produits', [HomeController::class, 'produits'])->name('produits');
    Route::post('/produits', [HomeController::class, 'createProduit'])->name('produits.store');
});
