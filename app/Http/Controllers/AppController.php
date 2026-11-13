<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Event;
use App\Models\Guest;
use App\Models\Rsvp;
use App\Models\Setting;
use App\Models\GoogleSheetSetting;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\File;
use ZipArchive;


class AppController extends Controller
{
    //


    public function index($app)
    {
        $event = Event::where('app_name', $app)->firstOrFail();
        // dd($event);

        $guests = Guest::with('response')->whereNotIn('guest_name', ['JUMLA','KAMATI'])->where('event_id', $event->id)->orderBy('rsvp_status','DESC')->get();
        $guestIds = $guests->pluck('id')->toArray();
        $sheet = GoogleSheetSetting::where('event_id', $event->id)->first();
        $setting = Setting::first();
        $resp = Rsvp::with('guest')->whereIn('guest_id', $guestIds)
            ->latest() // Orders by created_at DESC (or latest ID)
            ->get()
            ->unique('guest_id')
            ->values();
        // dd($guests,$resp);

        $stats = [
            'totalGuests' => Guest::where('event_id', $event->id)->whereNotIn('guest_name', ['JUMLA','KAMATI'])->count(),

            'sent' => Guest::where('event_id', $event->id)
                ->where('invitation_status', 'Sent')
                ->whereNotIn('guest_name', ['JUMLA','KAMATI'])
                ->count(),

            'pendingInvitation' => Guest::where('event_id', $event->id)
                ->where('invitation_status', 'Pending')
                 ->whereNotIn('guest_name', ['JUMLA','KAMATI'])
                ->count(),

            'accepted' => Guest::where('event_id', $event->id)
                ->where('rsvp_status', 'Accepted')
                 ->whereNotIn('guest_name', ['JUMLA','KAMATI'])
                ->count(),

            'declined' => Guest::where('event_id', $event->id)
                ->where('rsvp_status', 'Declined')
                 ->whereNotIn('guest_name', ['JUMLA','KAMATI'])
                ->count(),

            'pendingResponse' => Guest::where('event_id', $event->id)
                ->where('rsvp_status', 'Pending')
                 ->whereNotIn('guest_name', ['JUMLA','KAMATI'])
                ->count(),
            'app' => $app,
        ];
        $url = $setting->base_url . '/' . $app . '/cards/guest_';

        return view('dashboard', compact('event', 'setting', 'stats', 'guests', 'app', 'resp', 'sheet', 'url'));
    }

    public function deleteCards(Request $request)
{
    DB::beginTransaction();

    try {

        $event = Event::where('app_name', $request->guest_app)->first();
        $setting = Setting::first();

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found.'
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Get Guests
        |--------------------------------------------------------------------------
        */

        if ($request->filled('guest_token')) {

            // Single guest
            $guests = Guest::where('event_id', $event->id)
                ->where('invitation_token', $request->guest_token)
                ->get([
                    'id',
                    'guest_name',
                    'invitation_token'
                ])
                ->toArray();

        } elseif ($request->filled('guest_tokens')) {

            // Multiple guests
            $guestIds = $request->guest_tokens;

            $guests = Guest::where('event_id', $event->id)
                ->whereIn('id', $guestIds)
                ->get([
                    'id',
                    'guest_name',
                    'invitation_token'
                ])
                ->toArray();

        } else {

            // All guests
            $guests = Guest::where('event_id', $event->id)
                ->get([
                    'id',
                    'guest_name',
                    'invitation_token'
                ])
                ->toArray();
        }

        /*
        |--------------------------------------------------------------------------
        | Add app and URL information
        |--------------------------------------------------------------------------
        */

        foreach ($guests as &$guest) {

            $guest['app'] = $request->guest_app;
            $guest['url'] = $setting->base_url;
        }

        unset($guest);


        /*
        |--------------------------------------------------------------------------
        | Delete Only Selected Guest Cards
        |--------------------------------------------------------------------------
        |
        | Files are stored as:
        |
        | public/aa/cards/guest_1.png
        | public/aa/cards/guest_2.png
        | public/aa/cards/guest_3.png
        |
        |--------------------------------------------------------------------------
        */

        $folder = public_path($request->guest_app . '/cards');

        foreach ($guests as $guest) {

            $filePath = $folder . '/guest_' . $guest['id'] . '.png';

            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Update RSVP Information
        |--------------------------------------------------------------------------
        */

        foreach ($guests as $guest) {

            Guest::where('id', $guest['id'])
                ->update([
                    'rsvp_status' => $request->attendance,
                ]);

            $check = Rsvp::where('guest_id', $guest['id'])
                ->latest()
                ->first();

            if ($check) {

                $check->update([
                    'attendance'   => $request->attendance,
                    'adults'       => $request->adults,
                    'children'     => $request->children,
                    'message'      => $request->message,
                    'submitted_at' => now(),
                ]);

            } else {

                Rsvp::create([
                    'guest_id'     => $guest['id'],
                    'attendance'   => $request->attendance,
                    'adults'       => $request->adults,
                    'children'     => $request->children,
                    'message'      => $request->message,
                    'submitted_at' => now(),
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Commit Transaction
        |--------------------------------------------------------------------------
        */

        DB::commit();

        return response()->json([
            'success' => true,
            'guests'  => $guests,
            'message' => 'Guest card(s) deleted successfully.'
        ]);

    } catch (\Exception $e) {

        DB::rollBack();

        return response()->json([
            'success'   => false,
            'statusCode'=> 500,
            'message'   => $e->getMessage()
        ], 500);
    }
}

    public function sync_guest(Request $request, $app)
    {
        DB::beginTransaction();
        try {

            // dd($invitation_token);
            $event = Event::where('app_name', $app)->firstOrFail();


            // dd($request->all());

            foreach ($request->guests as $guest) {


                $check = Guest::where('guest_code', $guest['guest_code'])->where('event_id',$event->id)->exists();
                // dd($check);

                if (!$check) {
                    $invitation_token = Guest::generateCode(10);
                    if (strpos($guest['phone'], '0') === 0) {

                        $guest['phone'] = substr_replace($guest['phone'], '255', 0, 1);
                    }
                    $guest['event_id'] = $event->id;
                    $guest['invitation_token'] = $invitation_token;
                   if(isset($guest['date']) && $guest['date'] != null ){

                         if((int) str_replace(',', '', $guest['date']) > 100000 && (int) str_replace(',', '', $guest['amount']) == 0){

                            $guest['side'] = 'D';

                        }else if((int) str_replace(',', '', $guest['date']) == 0 ){
                            $guest['side'] = NULL;
                        }
                        else{

                            $guest['side'] = 'S';
                        }




                   }

                   $guest['id'] = $guest['guest_code'];

                    Guest::create($guest);
                }
                $id = Guest::find($guest['guest_code']);
                // dd($guest['guest_name'],$request->guest_name,$id->phone);
                $guest['guest_name'] = $guest['guest_name'];
                if ($check && $guest['phone'] && $id && !$id->phone) {
                    // dd($guest['phone'],$guest['date']);

                    // $invitation_token = Guest::generateCode(10);
                    if (strpos($guest['phone'], '0') === 0) {


                        $guest['phone'] = substr_replace($guest['phone'], '255', 0, 1);
                    }

                }
                // dd($guest['date']);

                if($check && isset($guest['date']) && $guest['date'] != null ){

                        if((int) str_replace(',', '', $guest['date']) > 100000 && (int) str_replace(',', '', $guest['amount']) == 0){

                            $guest['side'] = 'D';

                        }else if((int) str_replace(',', '', $guest['date']) == 0 ){
                            $guest['side'] = NULL;
                        }
                        else{

                            $guest['side'] = 'S';
                        }

                    }
                    // dd($guest);

                    if ($id) {
                        $id->update($guest);
                    }
            }

            DB::commit();
            // dd($guest);
            return response()->json([
                'status' => true,
                'statusCode' => 200,
                'message' => 'success'
            ], 500);
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function invitation($app, $token)
    {
        DB::beginTransaction();
        try {
            // dd('this');


            $event = Event::where('app_name', $app)->first();
            // dd($event);

            if (!$event) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 500,
                    'message' => 'Invalid token'
                ], 500);
            }

            $token = Guest::with('event')->where('event_id', $event->id)->where('invitation_token', $token)->first();
            // dd($token);
            if (!$token) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 500,
                    'message' => 'Invalid token'
                ], 500);
            }

            $token['url'] = Setting::first()->base_url;
            return view('index', compact('token', 'app','event'));


            // DB::commit();
        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => $e->getMessage()
            ], 500);
        }
    }


// public function generate(Request $request)
// {
//     $tmpFile = null;

//     try {
//         $event = Event::where('app_name', $request->guest_app)->first();
//         $setting = Setting::first();

//         if (!$event) {
//             return response()->json([
//                 'success' => false,
//                 'error' => 'Event not found.',
//             ], 404);
//         }

//         if (!$setting) {
//             return response()->json([
//                 'success' => false,
//                 'error' => 'Application settings not found.',
//             ], 500);
//         }

//         // Get guests based on the request
//         if ($request->filled('guest_token')) {

//             $guests = Guest::where('event_id', $event->id)
//                 ->where('invitation_token', $request->guest_token)
//                 ->get(['id', 'guest_name', 'invitation_token', 'side'])
//                 ->toArray();

//         } elseif ($request->filled('guest_tokens')) {

//         // dd($request->guest_tokens);
//         // array_push((array)$request->guest_tokens, '115');
//         // dd($request->guest_tokens);

//             $tokens = Guest::where('event_id', $event->id)
//                 ->whereIn('guest_code', (array) $request->guest_tokens)
//                 ->whereNotNull('side')
//                 ->where('rsvp_status', 'Pending')
//                 ->pluck('invitation_token')
//                 ->toArray();

//             $guests = Guest::where('event_id', $event->id)
//                 ->whereIn('invitation_token', $tokens)
//                 ->whereNotIn('guest_name', ['JUMLA','KAMATI'])
//                 ->get(['id', 'guest_name', 'invitation_token', 'side'])
//                 ->toArray();

//         } else {

//             $guests = Guest::where('event_id', $event->id)
//                 ->get(['id', 'guest_name', 'invitation_token', 'side'])
//                 ->toArray();
//         }

//         if (empty($guests)) {
//             return response()->json([
//                 'success' => false,
//                 'error' => 'No guests found to generate invitation cards.',
//             ], 404);
//         }

//         // dd($guests);
//         // Add application details to each guest
//         $url = $setting->base_url;
//         $code = Guest::where('event_id', $event->id)->value('invitation_token');

//         foreach ($guests as &$guest) {
//             $guest['app'] = $request->guest_app;
//             $guest['url'] = $url;
//             $guest['code'] = $code;
//         }
//         unset($guest);

//         // Detect operating system and select Python executable
//         if (PHP_OS_FAMILY === 'Linux') {
//             $python = base_path('.venv/bin/python');
//         } elseif (PHP_OS_FAMILY === 'Windows') {
//             $python = base_path('.venv-win\\Scripts\\python.exe');
//         } else {
//             return response()->json([
//                 'success' => false,
//                 'error' => 'Unsupported operating system: ' . PHP_OS_FAMILY,
//             ], 500);
//         }

//         $script = base_path('/python/generate_cards.py');

//         if (!file_exists($python)) {
//             return response()->json([
//                 'success' => false,
//                 'error' => 'Python executable not found: ' . $python,
//             ], 500);
//         }

//         if (!file_exists($script)) {
//             return response()->json([
//                 'success' => false,
//                 'error' => 'Python script not found: ' . $script,
//             ], 500);
//         }

//         // Encode guest data
//         $jsonGuests = json_encode(
//             $guests,
//             JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
//         );

//         if ($jsonGuests === false) {
//             return response()->json([
//                 'success' => false,
//                 'error' => 'Failed to encode guest data: ' . json_last_error_msg(),
//             ], 500);
//         }

//         // Write JSON to a temp file instead of passing it as an argument
//         $tmpFile = tempnam(sys_get_temp_dir(), 'guests_');

//         if ($tmpFile === false || file_put_contents($tmpFile, $jsonGuests) === false) {
//             return response()->json([
//                 'success' => false,
//                 'error' => 'Failed to write temporary guest data file.',
//             ], 500);
//         }

//         // Execute Python script with the FILE PATH
//         $process = new Process([
//             $python,
//             $script,
//             $tmpFile,
//         ]);

//         $process->setTimeout(null);
//         $process->run();

//         if (!$process->isSuccessful()) {
//             return response()->json([
//                 'success' => false,
//                 'error' => $process->getErrorOutput() ?: 'Python execution failed.',
//                 'output' => $process->getOutput(),
//                 'exit_code' => $process->getExitCode(),
//             ], 500);
//         }

//         $output = trim($process->getOutput());
//         $generated = json_decode($output, true);

//         if (json_last_error() !== JSON_ERROR_NONE || !is_array($generated)) {
//             return response()->json([
//                 'success' => false,
//                 'error' => 'Python returned invalid JSON: ' . json_last_error_msg(),
//                 'output' => $output,
//             ], 500);
//         }

//         if (empty($generated)) {
//             return response()->json([
//                 'success' => false,
//                 'error' => 'Python did not return any generated cards.',
//                 'output' => $output,
//             ], 500);
//         }

//         // Update guest RSVP information
//         foreach ($generated as $card) {

//             if (!isset($card['id'])) {
//                 continue;
//             }

//             Guest::where('id', $card['id'])
//                 ->where('event_id', $event->id)
//                 ->update([
//                     'rsvp_status' => 'Pending',
//                 ]);

//             $check = Rsvp::where('guest_id', $card['id'])
//                 ->latest()
//                 ->first();

//             $rsvpData = [
//                 'attendance' => $request->attendance,
//                 'adults' => $request->adults,
//                 'children' => $request->children,
//                 'message' => $request->message,
//                 'submitted_at' => now(),
//             ];

//             if ($check) {
//                 $check->update($rsvpData);
//             } else {
//                 Rsvp::create(array_merge(
//                     ['guest_id' => $card['id']],
//                     $rsvpData
//                 ));
//             }
//         }

//         return response()->json([
//             'success' => true,
//             'generated' => $generated,
//         ]);

//     } catch (\Throwable $e) {

//         return response()->json([
//             'success' => false,
//             'error' => $e->getMessage(),
//             'file' => config('app.debug') ? $e->getFile() : null,
//             'line' => config('app.debug') ? $e->getLine() : null,
//         ], 500);

//     } finally {
//         // Always clean up the temp file
//         if ($tmpFile && file_exists($tmpFile)) {
//             @unlink($tmpFile);
//         }
//     }
// }


public function generate(Request $request)
{
    $tmpFile = null;

    try {
        // 1. Validate event and settings
        $event = Event::where('app_name', $request->guest_app)->first();
        $setting = Setting::first();

        if (!$event) {
            return response()->json([
                'success' => false,
                'error' => 'Event not found.',
            ], 404);
        }

        if (!$setting) {
            return response()->json([
                'success' => false,
                'error' => 'Application settings not found.',
            ], 500);
        }

        // 2. Get guests based on request
        if ($request->filled('guest_token')) {

            $guests = Guest::where('event_id', $event->id)
                ->where('invitation_token', $request->guest_token)
                ->get([
                    'id',
                    'guest_name',
                    'invitation_token',
                    'side'
                ])
                ->toArray();

        } elseif ($request->filled('guest_tokens')) {

            $tokens = Guest::where('event_id', $event->id)
                ->whereIn('guest_code', (array) $request->guest_tokens)
                ->whereNotNull('side')
                ->where('rsvp_status', 'Pending')
                ->pluck('invitation_token')
                ->toArray();

            $guests = Guest::where('event_id', $event->id)
                ->whereIn('invitation_token', $tokens)
                ->whereNotIn('guest_name', ['JUMLA', 'KAMATI'])
                ->get([
                    'id',
                    'guest_name',
                    'invitation_token',
                    'side'
                ])
                ->toArray();

        } else {

            $guests = Guest::where('event_id', $event->id)
                ->get([
                    'id',
                    'guest_name',
                    'invitation_token',
                    'side'
                ])
                ->toArray();
        }

        // 3. Check guests
        if (empty($guests)) {
            return response()->json([
                'success' => false,
                'error' => 'No guests found to generate invitation cards.',
            ], 404);
        }

        // 4. Add application details
        $url = $setting->base_url;

        $code = Guest::where('event_id', $event->id)
            ->value('invitation_token');

        foreach ($guests as &$guest) {
            $guest['app'] = $request->guest_app;
            $guest['url'] = $url;
            $guest['code'] = $code;
        }

        unset($guest);

        // 5. Automatically detect Python executable

        $os = PHP_OS_FAMILY;

        if ($os === 'Windows') {

            $virtualPython = base_path('.venv-win\\Scripts\\python.exe');

            if (file_exists($virtualPython)) {
                $python = $virtualPython;
            } else {
                $python = 'python';
            }

        } elseif ($os === 'Linux') {

            $virtualPython = base_path('.venv/bin/python');

            if (file_exists($virtualPython)) {
                $python = $virtualPython;
            } else {
                $python = 'python3';
            }

        } else {

            return response()->json([
                'success' => false,
                'error' => 'Unsupported operating system: ' . $os,
            ], 500);
        }

        // 6. Locate Python script
        $script = base_path('python/generate_cards.py');

        if (!file_exists($script)) {
            return response()->json([
                'success' => false,
                'error' => 'Python script not found: ' . $script,
            ], 500);
        }

        // 7. Check Python installation
        $checkPython = new Process([
            $python,
            '--version'
        ]);

        $checkPython->setTimeout(30);
        $checkPython->run();

        if (!$checkPython->isSuccessful()) {
            return response()->json([
                'success' => false,
                'error' => 'Python is not installed or cannot be accessed.',
                'details' => $checkPython->getErrorOutput(),
                'python_path' => $python,
            ], 500);
        }

        // 8. Encode guest data
        $jsonGuests = json_encode(
            $guests,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        if ($jsonGuests === false) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to encode guest data: ' . json_last_error_msg(),
            ], 500);
        }

        // 9. Create temporary JSON file
        $tmpFile = tempnam(sys_get_temp_dir(), 'guests_');

        if ($tmpFile === false) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to create temporary file.',
            ], 500);
        }

        if (file_put_contents($tmpFile, $jsonGuests) === false) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to write temporary guest data file.',
            ], 500);
        }

        // 10. Execute Python script
        $process = new Process([
            $python,
            $script,
            $tmpFile,
        ]);

        $process->setTimeout(null);
        $process->run();

        if (!$process->isSuccessful()) {
            return response()->json([
                'success' => false,
                'error' => $process->getErrorOutput()
                    ?: 'Python execution failed.',
                'output' => $process->getOutput(),
                'exit_code' => $process->getExitCode(),
                'python_path' => $python,
            ], 500);
        }

        // 11. Read Python output
        $output = trim($process->getOutput());

        $generated = json_decode($output, true);

        if (
            json_last_error() !== JSON_ERROR_NONE ||
            !is_array($generated)
        ) {
            return response()->json([
                'success' => false,
                'error' => 'Python returned invalid JSON: ' . json_last_error_msg(),
                'output' => $output,
            ], 500);
        }

        if (empty($generated)) {
            return response()->json([
                'success' => false,
                'error' => 'Python did not return any generated cards.',
                'output' => $output,
            ], 500);
        }

        // 12. Update guest RSVP information
        foreach ($generated as $card) {

            if (!isset($card['id'])) {
                continue;
            }

            Guest::where('id', $card['id'])
                ->where('event_id', $event->id)
                ->update([
                    'rsvp_status' => 'Pending',
                ]);

            $check = Rsvp::where('guest_id', $card['id'])
                ->latest()
                ->first();

            $rsvpData = [
                'attendance' => $request->attendance,
                'adults' => $request->adults,
                'children' => $request->children,
                'message' => $request->message,
                'submitted_at' => now(),
            ];

            if ($check) {

                $check->update($rsvpData);

            } else {

                Rsvp::create(array_merge(
                    ['guest_id' => $card['id']],
                    $rsvpData
                ));
            }
        }

        // 13. Return generated cards
        return response()->json([
            'success' => true,
            'generated' => $generated,
        ]);

    } catch (\Throwable $e) {

        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'file' => config('app.debug') ? $e->getFile() : null,
            'line' => config('app.debug') ? $e->getLine() : null,
        ], 500);

    } finally {

        // 14. Always delete temporary file
        if ($tmpFile && file_exists($tmpFile)) {
            @unlink($tmpFile);
        }
    }
}


    public function response($token)
    {
        // dd($token,Setting::first());
        $guests = Guest::where('invitation_token', $token)->first();
        // dd($guests->event);

        if (!$guests) {
            return response()->json(['message' => 'Guest not found'], 404);
        }

        $guest = Rsvp::where('guest_id', $guests['id'])->first();

        return response()->json([
            'status' => 'success',
            'data' => [
                'has_responded' => true,
                'guest_name'    => $guests->guest_name,
                'attendance'    => $guest->attendance_status, // 'Accepted' or 'Declined'
                'adults'        => $guest->adults,
                'children'      => $guest->children,
                'notes'         => $guest->message,
                'ticket_base64' => '/' . $guests->event->app_name . '/cards/guest_' . $guests->id . '.png',
            ]

            //  var image_url = data.url + '/' + data.event.app_name + '/cards/' + 'guest_' + data.id + '.png';
        ]);
    }

    public function downloadCards(Request $request)
{
    try {

        $event = Event::where('app_name', $request->guest_app)->first();

        if (!$event) {
            return response()->json([
                'success' => false,
                'message' => 'Event not found.'
            ], 404);
        }

        /*
        |--------------------------------------------------------------------------
        | Get Selected Guests
        |--------------------------------------------------------------------------
        */

        if ($request->filled('guest_token')) {

            $guests = Guest::where('event_id', $event->id)
                ->where('invitation_token', $request->guest_token)
                  ->where('side', '!=', null)
                ->get([
                    'id',
                    'guest_name',
                    'invitation_token'
                ]);

        } elseif ($request->filled('guest_tokens')) {

            $guests = Guest::where('event_id', $event->id)
                ->whereIn('guest_code', $request->guest_tokens)
                 ->whereNotNull('side')
                  ->whereNotIn('guest_name', ['JUMLA','KAMATI'])
                  ->where('rsvp_status','Pending')
                ->get([
                    'id',
                    'guest_name',
                    'invitation_token'
                ]);

        } else {

            $guests = Guest::where('event_id', $event->id)
              ->where('side', '!=', null)
                ->get([
                    'id',
                    'guest_name',
                    'invitation_token'
                ]);
        }

        // dd($guests);

        /*
        |--------------------------------------------------------------------------
        | Check Guests
        |--------------------------------------------------------------------------
        */

        if ($guests->isEmpty()) {

            return response()->json([
                'success' => false,
                'message' => 'No guests found.'
            ], 404);
        }


        /*
        |--------------------------------------------------------------------------
        | Cards Folder
        |--------------------------------------------------------------------------
        */

        $cardsFolder = public_path($request->guest_app . '/cards');

        if (!File::exists($cardsFolder)) {

            return response()->json([
                'success' => false,
                'message' => 'Cards folder does not exist.'
            ], 404);
        }


        /*
        |-------------------------------------------------------------------------
        | Create ZIP
        |--------------------------------------------------------------------------
        */

        $zipFileName = 'selected_cards_' . time() . '.zip';

        $zipPath = storage_path('app/' . $zipFileName);

        $zip = new ZipArchive();

        if ($zip->open(
            $zipPath,
            ZipArchive::CREATE | ZipArchive::OVERWRITE
        ) !== true) {

            return response()->json([
                'success' => false,
                'message' => 'Unable to create ZIP file.'
            ], 500);
        }


        /*
        |--------------------------------------------------------------------------
        | Add Cards
        |--------------------------------------------------------------------------
        */

        $addedFiles = 0;

        foreach ($guests as $guest) {

            // Actual file on server
            $fileName = 'guest_' . $guest->id . '.png';

            $filePath = $cardsFolder . '/' . $fileName;


            if (File::exists($filePath)) {

                /*
                |--------------------------------------------------------------------------
                | Create ZIP File Name From Guest Name
                |--------------------------------------------------------------------------
                */

                $zipFileNameForGuest = strtolower($guest->guest_name);

                // Replace & with "and"
                $zipFileNameForGuest = str_replace(
                    '&',
                    'and',
                    $zipFileNameForGuest
                );

                // Replace any non-alphanumeric characters with underscore
                $zipFileNameForGuest = preg_replace(
                    '/[^a-z0-9]+/',
                    '_',
                    $zipFileNameForGuest
                );

                // Remove underscores from beginning/end
                $zipFileNameForGuest = trim(
                    $zipFileNameForGuest,
                    '_'
                );

                // Add PNG extension
                $zipFileNameForGuest .= '.png';


                /*
                |--------------------------------------------------------------------------
                | Add File To ZIP With Guest Name
                |--------------------------------------------------------------------------
                */

                $zip->addFile(
                    $filePath,
                    $zipFileNameForGuest
                );

                $addedFiles++;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Close ZIP
        |--------------------------------------------------------------------------
        */

        $zip->close();


        /*
        |--------------------------------------------------------------------------
        | Check If Files Were Added
        |--------------------------------------------------------------------------
        */

        if ($addedFiles === 0) {

            if (File::exists($zipPath)) {
                File::delete($zipPath);
            }

            return response()->json([
                'success' => false,
                'message' => 'No card files were found for the selected guests.'
            ], 404);
        }


        foreach ($guests as $guest) {
            Guest::where('id', $guest['id'])
                ->where('event_id', $event->id)
                ->update([
                    'rsvp_status' => 'Accepted',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Download ZIP
        |--------------------------------------------------------------------------
        */

        return response()->download(
            $zipPath,
            $zipFileName,
            [
                'Content-Type' => 'application/zip'
            ]
        )->deleteFileAfterSend(true);


    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'statusCode' => 500,
            'message' => $e->getMessage()
        ], 500);
    }
}



}
