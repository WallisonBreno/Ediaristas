<?php

use App\Http\Controllers\DiaristaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [
    DiaristaController::class,'index'
])->name('diaristas.index');


Route::get('/diarsta/create', [
    DiaristaController::class,'create'
])->name('diaristas.create');


Route::post('/diarsta', [
    DiaristaController::class,'store'
])->name('diaristas.store');


Route::get('/diarista/{id}/edit',[
    DiaristaController::class, 'edit'
])->name('diaristas.edit');


Route::put('/diarista/{id}', [
    DiaristaController::class,'update'
])->name('diaristas.update');


Route::get('/diarista/{id}/delete',[
    DiaristaController::class, 'destroy'
])->name('diaristas.destroy');

