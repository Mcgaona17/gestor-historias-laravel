<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HistoriaController;

Route::get('/', function () {
    return redirect()->route('board'); // Redirige a la vista Kanban
});

// Rutas para Historias
Route::prefix('historias')->group(function () {
    Route::get('/crear', [HistoriaController::class, 'create'])->name('historias.create');
    Route::post('/', [HistoriaController::class, 'store'])->name('historias.store');
    Route::get('/{historia}/editar', [HistoriaController::class, 'edit'])->name('historias.edit');
    Route::put('/{historia}', [HistoriaController::class, 'update'])->name('historias.update');
    Route::delete('/{historia}', [HistoriaController::class, 'destroy'])->name('historias.destroy');
});

// Tablero Kanban
Route::get('/board', [HistoriaController::class, 'board'])->name('board');
Route::resource('historias', HistoriaController::class)->except(['show']);