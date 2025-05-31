<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SprintController;
use App\Http\Controllers\HistoriaController;

Route::get('sprints', [SprintController::class, 'index']);
Route::post('sprints', [SprintController::class, 'store']);
Route::get('sprints/{id}', [SprintController::class, 'show']);
Route::put('sprints/{id}', [SprintController::class, 'update']);
Route::delete('sprints/{id}', [SprintController::class, 'destroy']);

Route::get('historias', [HistoriaController::class, 'index']);
Route::post('historias', [HistoriaController::class, 'store']);
Route::get('historias/{id}', [HistoriaController::class, 'show']);
Route::put('historias/{id}', [HistoriaController::class, 'update']);
Route::delete('historias/{id}', [HistoriaController::class, 'destroy']);

Route::apiResource('sprints', SprintController::class);
Route::apiResource('historias', HistoriaController::class);

Route::get('board', [HistoriaController::class, 'board']);
Route::get('/reporte-sprint/{sprint}', [HistoriaController::class, 'reporteSprint']);