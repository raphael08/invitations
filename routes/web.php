<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Models\Guest;
use Illuminate\Support\Facades\File;
Route::get('/', function () {

// $guests = Guest::where('rsvp_status','Accepted')->get();

// foreach( $guests as $guest ){
//     $guest->update(['rsvp_status'=>'Pending']);
// }

// Guest::truncate();

// $folder = public_path('aa/cards');

// if (File::exists($folder)) {
//     foreach (File::files($folder) as $file) {
//         File::delete($file);
//     }
// }

});

 Route::get('/api/inv/{app}', [AppController::class, 'index']);
 Route::post('/{app}/sync_guest', [AppController::class, 'sync_guest']);
 Route::get('/{app}/{token}', [AppController::class, 'invitation']);
 Route::get('/api/response/{token}', [AppController::class, 'response']);
 Route::post('/generate', [AppController::class, 'generate']);

