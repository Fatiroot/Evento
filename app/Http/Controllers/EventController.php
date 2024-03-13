<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventStoreRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $events = Event::where('user_id', $user->id)->get();
        return view('organizer.events.index', compact('events'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('organizer.events.create', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventStoreRequest $request)
    {
        $events= Event::create($request->all());
        $events->addMediaFromRequest('image')->toMediaCollection('images');
        return redirect()->route('events.index')->with('success', 'Event created successfuly');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {

        $categories = Category::all();
        return view('organizer.events.edit', compact(['categories','event']));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventUpdateRequest $request, Event $event)
    {
        $event->update($request->except('image'));

        if ($request->hasFile('image')) {
            $event->clearMediaCollection('images');
            $event->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->back()->with('success', 'Event deleted successfuly');

    }
    public function allevents()
    {
        $events=Event::all();
        return view('admin.events.index',compact('events'));

    }

    public function eventshome()
{
    $categories=Category::all();
    $events = Event::where('status_published',1)->where('status',0)->where('start_date', '>', now())->where('end_date', '>', now())->paginate(3);
    return view('home', compact(['events','categories']));
}

    public function showevent($id){
        $event = Event::with('category')->findOrFail($id);

        return view('DetailEvent', compact('event'));
    }



    public function updateStatusPublished(Request $request, Event $event)
{
    $event->update(['status_published' => !$event->status_published]);

    return redirect()->route('events.index');
}



public function updateAutomaticAcceptance(Request $request, Event $event)
{
    $event->update(['automatic_acceptance' => !$event->automatic_acceptance]);
    return redirect()->route('events.index');
}


public function updateStatus(Request $request, Event $event)
{
    $event->update(['status' => !$event->status]);
    return redirect()->route('allevents');
}


public function search(Request $request) {
    $categoryKeyword = $request->query('category_keyword');
    $eventKeyword = $request->query('event_keyword');
    $categories = Category::all();

    $eventsQuery = Event::query();

    if ($eventKeyword) {
        $eventsQuery->where(function ($query) use ($eventKeyword) {
            $query->where('title', 'like', '%' . $eventKeyword . '%')
                  ->orWhere('description', 'like', '%' . $eventKeyword . '%');
        });
    }

    if ($categoryKeyword) {
        $eventsQuery->orWhereHas('category', function ($query) use ($categoryKeyword) {
            $query->where('name', 'like', '%' . $categoryKeyword . '%');
        });
    }

    $events = $eventsQuery->paginate(3);

    return view('home', compact('events', 'eventKeyword', 'categoryKeyword', 'categories'));
}

}
