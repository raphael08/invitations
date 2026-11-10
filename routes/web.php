<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Models\Guest;
use Illuminate\Support\Facades\File;
use App\Models\Event;
use App\Models\GoogleSheetSetting;
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

// Event::find(2)->update([
//     "event_type_id"=> "1",
//     "app_name"=>"hj",
//     "bride_name"=>"Janeth",
//     "groom_name"=>"Hans",
//     "wedding_title"=>"Hans & Janeth",
//     "background_music"=>"music.mp3",
//     "event_date"=>"15-11-2026",
//     "cover_image"=>"https://images.unsplash.com/photo-1519741497674-611481863552?auto=format&fit=crop&w=1920&q=80"
//       ]);

    //  \App\Models\Guest::truncate();
    //   $sheet = GoogleSheetSetting::where('event_id', 2)->update(['spreadsheet_id'=>'https://docs.google.com/spreadsheets/d/e/2PACX-1vSKx_piis4_kPy3obNJrDWVwmPPhGw8rtm2eAGDT-ZiWx72mWC0qTuiSct6cLfX70Otku6dLwYEZI81/pub?output=csv']);


});

 Route::get('/api/inv/{app}', [AppController::class, 'index']);
 Route::post('/{app}/sync_guest', [AppController::class, 'sync_guest']);
 Route::get('/{app}/{token}', [AppController::class, 'invitation']);
 Route::get('/api/response/{token}', [AppController::class, 'response']);
 Route::post('/generate', [AppController::class, 'generate']);
 Route::post('/downloadCards', [AppController::class, 'downloadCards']);

