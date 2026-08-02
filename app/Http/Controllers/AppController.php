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

class AppController extends Controller
{
    //


    public function index($app)
    {
        $event = Event::where('app_name', $app)->firstOrFail();
        $guests = Guest::with('response')->where('event_id', $event->id)->get();
        $guestIds = $guests->pluck('id')->toArray();
        $sheet = GoogleSheetSetting::where('event_id', $event->id)->first();
        $setting = Setting::first();
        $resp = Rsvp::with('guest')->whereIn('guest_id', $guestIds)
            ->latest() // Orders by created_at DESC (or latest ID)
            ->get()
            ->unique('guest_id') // Keeps only the first (latest) item for each guest_id
            ->values();
        // dd($guests,$resp);

        $stats = [
            'totalGuests' => Guest::where('event_id', $event->id)->count(),

            'sent' => Guest::where('event_id', $event->id)
                ->where('invitation_status', 'Sent')
                ->count(),

            'pendingInvitation' => Guest::where('event_id', $event->id)
                ->where('invitation_status', 'Pending')
                ->count(),

            'accepted' => Guest::where('event_id', $event->id)
                ->where('rsvp_status', 'Accepted')
                ->count(),

            'declined' => Guest::where('event_id', $event->id)
                ->where('rsvp_status', 'Declined')
                ->count(),

            'pendingResponse' => Guest::where('event_id', $event->id)
                ->where('rsvp_status', 'Pending')
                ->count(),
            'app' => $app,
        ];
        $url = $setting->base_url . '/' . $app . '/cards/guest_';

        return view('dashboard', compact('event', 'setting', 'stats', 'guests', 'app', 'resp', 'sheet', 'url'));
    }

    public function sync_guest(Request $request, $app)
    {
        DB::beginTransaction();
        try {

            // dd($invitation_token);
            $event = Event::where('app_name', $app)->firstOrFail();


            // dd($request->all());

            foreach ($request->guests as $guest) {


                $check = Guest::where('guest_code', $guest['guest_code'])->exists();

                if (!$check) {
                    $invitation_token = Guest::generateCode(10);
                    if (strpos($guest['phone'], '0') === 0) {

                        $guest['phone'] = substr_replace($guest['phone'], '255', 0, 1);
                    }
                    $guest['event_id'] = $event->id;
                    $guest['invitation_token'] = $invitation_token;
                    Guest::create($guest);
                }
                $id = Guest::find($guest['guest_code']);
                if ($check && $guest['phone'] && $id && !$id->phone) {
                    // dd($guest['phone']);

                    // $invitation_token = Guest::generateCode(10);
                    if (strpos($guest['phone'], '0') === 0) {


                        $guest['phone'] = substr_replace($guest['phone'], '255', 0, 1);
                    }



                    if ($id) {
                        $id->update($guest);
                    }
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
            if (!$token) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 500,
                    'message' => 'Invalid token'
                ], 500);
            }

            $token['url'] = Setting::first()->base_url;
            return view('index', compact('token', 'app'));


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

    public function generate(Request $request)
    {

        // dd($request->all());
        $event = Event::where('app_name', $request->guest_app)->first();
        $setting = Setting::first();
        if ($request->filled('guest_token')) {

            $guests = Guest::where('event_id', $event->id)->where('invitation_token', $request->guest_token)
                ->get(['id', 'guest_name', 'invitation_token'])
                ->toArray();
        } elseif ($request->filled('guest_tokens')) {


            // FIXED: Changed $request->guest_token to $request->guest_tokens to extract the incoming array properly
            $tokens = Guest::whereIn('id', $request->guest_tokens)->get('invitation_token')->toArray();
            // dd($tokens);
            $guests = Guest::where('event_id', $event->id)->whereIn('invitation_token', $tokens)
                ->get(['id', 'guest_name', 'invitation_token'])
                ->toArray();

            // dd($guests);

            // if ($guests) {
            //     $guests['app'] = $request->guest_app;
            //     $guests['url'] = $setting->base_url;
            // }
        } else {

            $guests = Guest::get(['id', 'guest_name', 'invitation_token'])
                ->toArray();
            if ($guests) {
                $guests['app'] = $request->guest_app;
                $guests['url'] = $setting->base_url;
            }
        }

        // dd($guests);
        if (!empty($guests)) {
            foreach ($guests as &$guest) {
                $guest['app'] = $request->guest_app;
                $guest['url'] = $setting->base_url;
            }
            unset($guest); // Break references safely
        }

        // dd($guests);
        // $python = '/usr/bin/python3';
        $python = base_path('.venv/bin/python');
        // or base_path('.venv/bin/python')


        $script = base_path('python/generate_cards.py');


        $process = new Process([
            $python,
            $script,
            json_encode($guests)
        ]);

        $process->setTimeout(0);

        $process->run();

        // dd($process->getOutput());

        if (!$process->isSuccessful()) {



            return response()->json([
                'success' => false,
                'error' => $process->getErrorOutput()
            ], 500);
        }

        $generated = json_decode(
            $process->getOutput(),
            true
        );
        // dd($generated);

        // dd(json_decode(json_encode($process->getOutput())));

        foreach ($generated as $card) {

            Guest::where('id', $card['id'])
                ->update([
                    // 'invitation_image' => $card['image'],
                    'rsvp_status' => $request->attendance,
                ]);
            $check = Rsvp::where('guest_id', $card['id'])->latest()->first();
            if ($check) {
                $check->update(['attendance' => $request->attendance, 'adults' => $request->adults, 'children' => $request->children, 'message' => $request->message, 'submitted_at' => now()]);
            } else {

                Rsvp::create(['guest_id' => $card['id'], 'attendance' => $request->attendance, 'adults' => $request->adults, 'children' => $request->children, 'message' => $request->message, 'submitted_at' => now()]);
            }
        }

        return response()->json([
            'success' => true,
            'generated' => $generated
        ]);
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
                'ticket_base64' => Setting::first()->base_url . '/' . $guests->event->app_name . '/cards/guest_' . $guests->id . '.png',
            ]

            //  var image_url = data.url + '/' + data.event.app_name + '/cards/' + 'guest_' + data.id + '.png';
        ]);
    }
}
