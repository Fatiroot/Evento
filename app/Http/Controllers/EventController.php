<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events=Event::all();
        return view('admin.events.index',compact('events'));
      
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
    public function store(Request $request)
    {
        $events= Event::create($request->all());
        $events->addMediaFromRequest('image')->toMediaCollection('images');
        return redirect()->route('allevents')->with('success', 'Event created successfuly');
    
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $events=Event::all();
        return view('organizer.events.index',compact('events'));
      
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
    public function update(Request $request, Event $event)
    {
        $event->update($request->except('image'));
    
        if ($request->hasFile('image')) {
            $event->clearMediaCollection('images');
            $event->addMediaFromRequest('image')->toMediaCollection('images');
        }
    
        return redirect()->route('allevents');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
    public function allevents()
    {
        $events=Event::all();
        return view('organizer.events.index',compact('events'));
      
    }
    public function updateStatusPublished(Request $request, Event $event)
{
    $event->update(['status_published' => !$event->status_published]);

    return redirect()->route('allevents');
}

public function updateAutomaticAcceptance(Request $request, Event $event)
{
    $event->update(['automatic_acceptance' => !$event->automatic_acceptance]);
    return redirect()->route('allevents');
}
public function updateStatus(Request $request, Event $event)
{
    $event->update(['status' => !$event->status]);
    return redirect()->route('events.index');
}

}
