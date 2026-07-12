<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Event;
use App\Models\Guest;
use App\Models\Rsvp;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class AppController extends Controller
{
    //


    public function index($app)
    {
        $event = Event::where('app_name', $app)->firstOrFail();
        $guests = Guest::where('event_id', $event->id)->get();

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

        return view('dashboard', compact('event', 'stats', 'guests', 'app'));
    }

    public function sync_guest(Request $request, $app)
    {
        DB::beginTransaction();
        try {

            // dd($invitation_token);
            $event = Event::where('app_name', $app)->firstOrFail();


            // dd($request->guests);

            foreach ($request->guests as $guest) {
                $invitation_token = Guest::generateCode(10);
                $guest['event_id'] = $event->id;
                $guest['invitation_token'] = $invitation_token;


                Guest::create($guest);
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
        // DB::beginTransaction();
        try {
            $event = Event::where('app_name', $app)->first();

            if (!$event) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 500,
                    'message' => 'Invalid token'
                ], 500);
            }

            $token = Guest::where('event_id', $event->id)->where('invitation_token', $token)->first();
            if (!$token) {
                return response()->json([
                    'status' => false,
                    'statusCode' => 500,
                    'message' => 'Invalid token'
                ], 500);
            }

            return view('index', compact('token', 'app'));


            // DB::commit();
        } catch (\Exception $e) {

            // DB::rollBack();

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
        if ($request->filled('guest_token')) {

            $guests = Guest::where('event_id', $event->id)->where('invitation_token', $request->guest_token)
                ->get(['id', 'invitation_token','guest_name'])
                ->toArray();
        } elseif ($request->filled('guest_tokens')) {

            $guests = Guest::where('event_id', $event->id)->whereIn('invitation_token', $request->guest_token)
                ->get(['id', 'guest_name','invitation_token'])
                ->toArray();
        } else {

            $guests = Guest::get(['id', 'guest_name','invitation_token'])
                ->toArray();
        }

        // dd($guests);
        if($guests){
            $guests['app'] = $request->guest_app;
        }
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

        foreach ($generated as $card) {

            Guest::where('id', $card['id'])
                ->update([
                    // 'invitation_image' => $card['image'],
                    'rsvp_status' => $request->attendance,
                ]);
            Rsvp::create(['guest_id' => $card['id'], 'attendance' => $request->attendance, 'adults' => $request->adults, 'children' => $request->children, 'message' => $request->message, 'submitted_at' => now()]);
        }

        return response()->json([
            'success' => true,
            'generated' => $generated
        ]);
    }
}
