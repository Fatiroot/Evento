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

public function reservation(Request $request){
    $validated = $request->validate([
        'event_id' => 'required|exists:events,id',
        'reservation_date',
    ]);
    $user=User::findOrfail($request->user_id);
    $event = Event::findOrFail($request->event_id);
    if ($event->available_seats <= 0) {
        return redirect()->back();
    }

    $event->available_seats--;
    $event->save();

    if ($event->automatic_acceptance == 1) {
        $user->events()->attach([$request->event_id => [
            'reservation_date' => now(),
            'status' => 1
        ]]);
        return redirect()->route('ticket', $request->event_id);
    } else {
        $user->events()->attach([$request->event_id => [
            'reservation_date' => now(),
            'status' => 0
        ]]);
        return redirect()->route('event.show', $event->id)->with('success', 'Reservation request sent. It will be confirmed once approved.');
    }
}



    public function organizerStatistic(){
        $userId = Auth::user()->id;
        $eventcount = Event::where('user_id', $userId)->count();
        $reservationCount = EventUser::whereHas('event', function($query) use($userId){
            $query->where('user_id',$userId);
        })->count();        return view('organizer.dashboard',compact('eventcount','reservationCount'));
    }

    public function updateStatus(Request $request, EventUser $eventuser)
{
    $eventuser->update(['status' => !$eventuser->status]);
//  dd($data);
return redirect()->back()->with('success', 'Reservation approved successfully.');
}


}
