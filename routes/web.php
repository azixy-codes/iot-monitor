<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\HistoriqueController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\TypeMesureController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Accessible uniquement aux utilisateurs connectés
Route::middleware('auth')->group(function () {

    // Pour executer le script de simulation 
    Route::get('/modules/regeneration_etat', [CommandController::class, ('execute')])->name('modules.regeneration.etat');

    // Tableau de bord
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // les routes des Modules
    Route::controller(ModuleController::class)->group(function () {
        Route::get('/modules', 'index')->name('modules.index');
        Route::get('/modules/create', 'create')->name('modules.create');
        Route::get('/modules/{id}', 'show')->name('modules.show');
        Route::post('/modules', 'store')->name('modules.store');
        Route::get('/modules/{id}/edit', 'edit')->name('modules.edit');
        Route::put('/modules/{id}', 'update')->name('modules.update');
        Route::delete('/modules/{id}', 'destroy')->name('modules.destroy');
    });

    // Les routes des Type de mesures
    Route::controller(TypeMesureController::class)->group(function () {
        Route::get('types-mesures', 'index')->name('types_mesures.index');
        Route::get('types-mesures/create', 'create')->name('types_mesures.create');
        Route::post('types-mesures', 'store')->name('types_mesures.store');
        Route::get('types-mesures/{id}/edit', 'edit')->name('types_mesures.edit');
        Route::put('types-mesures/{id}', 'update')->name('types_mesures.update');
        Route::delete('types-mesures/{id}', 'destroy')->name('types_mesures.destroy');
    });

    // Route de l'historique
    Route::controller(HistoriqueController::class)->group(function () {
        Route::get('/historique', 'index')->name('historique.index');
    });

    // Les routes des notifications
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/notifications', 'index')->name('notifications.index');
        Route::get('/notifications/read/{id}', 'read')->name('notifications.read');
        Route::get('/notification/{id}', 'show')->name('notifications.show');
    });
});

// Les routes d'authentification
require __DIR__ . '/auth.php';
