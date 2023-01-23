<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEventsRequest;
use App\Http\Requests\Admin\UpdateEventsRequest;

class EventsController extends Controller
{
    /**
     * Display a listing of Event.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('event_access')) {
            return abort(401);
        }

        $events = Event::all();

        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating new Event.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('event_create')) {
            return abort(401);
        }
        return view('admin.events.create');
    }

    /**
     * Store a newly created Event in storage.
     *
     * @param  \App\Http\Requests\StoreEventsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('event_create')) {
            return abort(401);
        }

        $this->validate($request, [
            'title' => 'required',
            'start_time' => 'required|date_format:'.config('app.date_format').' H:i:s',
            'venue' => 'required',
            'image' => 'required',
            'ticket_id' => 'required',
        ]);

       


        if($request->file('image')){
            $rand=rand(11111,111111);
            $imageName1 = $rand.''.time().'.'.$request->image->extension();  
     
            $request->image->move(public_path('static/images/events'), $imageName1);  
        }

        $event = new Event;
        $event->title = $request->title;
        $event->start_time = $request->start_time;
        $event->venue = $request->venue;
        $event->image = $imageName1;
        $event->ticket_id = $request->ticket_id;
     //   dd($event);
        $event->save();


        
      //  dd($request->all());
      //  $event = Event::create($request->all());



        return redirect()->route('admin.events.index');
    }


    /**
     * Show the form for editing Event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('event_edit')) {
            return abort(401);
        }
        $event = Event::findOrFail($id);

        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update Event in storage.
     *
     * @param  \App\Http\Requests\UpdateEventsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEventsRequest $request, $id)
    {
        if (! Gate::allows('event_edit')) {
            return abort(401);
        }
        $event = Event::findOrFail($id);
        $event->update($request->all());



        return redirect()->route('admin.events.index');
    }


    /**
     * Display Event.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('event_view')) {
            return abort(401);
        }
        $tickets = \App\Ticket::where('event_id', $id)->get();

        $event = Event::findOrFail($id);

        return view('admin.events.show', compact('event', 'tickets'));
    }


    /**
     * Remove Event from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('event_delete')) {
            return abort(401);
        }
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index');
    }

    /**
     * Delete all selected Event at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('event_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Event::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

}
