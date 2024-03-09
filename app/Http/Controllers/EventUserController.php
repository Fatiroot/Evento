<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class EventUserController extends Controller
{
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

        $user->events()->syncWithoutDetaching([$request->event_id => [
            'reservation_date' => now(),
            'status' => 1
        ]]);
        return redirect()->route('ticket', $request->event_id);
    }

}
