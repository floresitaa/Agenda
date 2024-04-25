<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_events = Event::all();
        $eventos = Event::all();
        $events = [];
        foreach($all_events as $event)
        {
            $events[] = [
                'title'=> $event->event,
                'start'=>$event->start_event,
                'end'=>$event->end_event,
            ];
        }
        return view('calendario.index', compact('events','eventos')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        return view('calendario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event' => 'required',
            'start_event' => 'required',
            'end_event' => 'required',
        ]);
        $event = new Event();
        $event->event = $request->input('event');
        $event->start_event = $request->input('start_event');
        $event->end_event = $request->input('end_event');
        $event ->save();
        return view("calendario.message", ['msg' => "Feriado/actividad registrada con éxito"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $event = Event::find($id);
        return view('calendario.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'event' => 'required',
            'start_event' => 'required',
            'end_event' => 'required',
        ]);
        $event = Event::find($id);
        $event->event = $request->input('event');
        $event->start_event = $request->input('start_event');
        $event->end_event = $request->input('end_event');
        $event ->save();
        return view("calendario.message", ['msg' => "Feriado/actividad actualizada con éxito"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event= event::find($id);
        $event->delete();
        return redirect()->route('calendario.index'); //
    }
}
