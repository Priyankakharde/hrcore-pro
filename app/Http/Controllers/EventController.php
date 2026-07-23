<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display Events
     */
    public function index()
    {
        $events = Event::latest()->get();

        $totalEvents = Event::count();

        $upcomingEvents = Event::where('status', 'Upcoming')->count();

        $completedEvents = Event::where('status', 'Completed')->count();

        $ongoingEvents = Event::where('status', 'Ongoing')->count();

        return view('events.index', compact(
            'events',
            'totalEvents',
            'upcomingEvents',
            'completedEvents',
            'ongoingEvents'
        ));
    }

    /**
     * Show Create Form
     */
    public function create()
    {
        return view('events.create');
    }

    /**
     * Store Event
     */
    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required',

            'event_type' => 'required',

            'organizer' => 'required',

            'event_date' => 'required',

            'start_time' => 'required',

            'end_time' => 'required',

            'location' => 'required',

            'priority' => 'required',

            'status' => 'required',

        ]);

        Event::create([

            'title' => $request->title,

            'event_type' => $request->event_type,

            'organizer' => $request->organizer,

            'event_date' => $request->event_date,

            'start_time' => $request->start_time,

            'end_time' => $request->end_time,

            'location' => $request->location,

            'priority' => $request->priority,

            'description' => $request->description,

            'status' => $request->status,

        ]);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event created successfully!');
    }

    /**
     * Show Single Event
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    /**
     * Show Edit Form
     */
    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    /**
     * Update Event
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([

            'title' => 'required',

            'event_type' => 'required',

            'organizer' => 'required',

            'event_date' => 'required',

            'start_time' => 'required',

            'end_time' => 'required',

            'location' => 'required',

            'priority' => 'required',

            'status' => 'required',

        ]);

        $event->update([

            'title' => $request->title,

            'event_type' => $request->event_type,

            'organizer' => $request->organizer,

            'event_date' => $request->event_date,

            'start_time' => $request->start_time,

            'end_time' => $request->end_time,

            'location' => $request->location,

            'priority' => $request->priority,

            'description' => $request->description,

            'status' => $request->status,

        ]);

        return redirect()
            ->route('events.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Delete Event
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()
            ->route('events.index')
            ->with('success', 'Event deleted successfully!');
    }
}