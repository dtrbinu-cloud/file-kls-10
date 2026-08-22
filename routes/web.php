<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\gambarcontrol;

Route::get('/', function () {
    return redirect()->route('gambar.index');
});

Route::get('/gambar', [gambarcontrol::class, 'index'])
    ->name('gambar.index');

Route::post('/gambar', [gambarcontrol::class, 'store'])
    ->name('gambar.store');

Route::delete('/gambar/{gambar}', [gambarcontrol::class, 'destroy'])
    ->name('gambar.destroy');