<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
Route::get('/', function () {
    return view('dashboard');
});

 Route::get('/{app}', [AppController::class, 'index']);
 Route::post('/{app}/sync_guest', [AppController::class, 'sync_guest']);
 Route::get('/{app}/{token}', [AppController::class, 'invitation']);
 Route::post('/generate', [AppController::class, 'generate']);

