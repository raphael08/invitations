<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Event;
use App\Models\Guest;
use Illuminate\Support\Facades\DB;
class AppController extends Controller
{
    //


    public function index($app)
    {
        $event = Event::where('app_name', $app)->firstOrFail();

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

        return view('dashboard', compact('event', 'stats'));
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
        }
        catch (\Exception $e) {

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

            if(!$event){
                return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => 'Invalid token'
            ], 500);
            }

            $token = Guest::where('event_id', $event->id)->where('invitation_token', $token)->first();
            if(!$token){
                return response()->json([
                'status' => false,
                'statusCode' => 500,
                'message' => 'Invalid token'
            ], 500);
            }

            return view('index',compact('token'));


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
}
