<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventUserController extends Controller
{
    public function index(){
        $userId = Auth::user()->id;
        $reservations = EventUser::with('user')->whereHas('event', function($query) use($userId){
            $query->where('user_id',$userId);
        })->get();

    return view('organizer.reservation.index', compact('reservations'));
}

    public function reservation(Request $request, User $user){
        $validated = $request->validate([
            'event_id' => 'required|exists:events,id',
            'reservation_date',
        ]);

        $event = Event::findOrFail($request->event_id);
        if ($event->available_seats<= 0) {
            return redirect()->back()->with('error', 'No available seats for this event.');
        }
        $event->available_seats--;
        $event->save();

        $user->events()->attach([$request->event_id => [
            'reservation_date' => now(),
            'status' => 1
        ]]);
        return redirect()->route('ticket', $request->event_id);
    }


    public function organizerStatistic(){
        $eventcount = Event::count();
        $reservationCount =EventUser::count();
        return view('organizer.dashboard',compact('eventcount','reservationCount'));
    }


}
