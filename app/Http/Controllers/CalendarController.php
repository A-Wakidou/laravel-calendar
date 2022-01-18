<?php

namespace App\Http\Controllers;
use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index() {
        $events = Events::all();
        return view('calendar', ['events' => $events]);
    }

    public function createEvent(Request $request) {
        $query = DB::table('events')->insert([
            'title'=>$request->input('title'),
            'start'=>$request->input('startDate'),
            'end'=>$request->input('endDate'),
        ]);
        if($query) {
            return back()->with('success', 'Event created');
        }
        else {
            return back()->with('fail', 'Something went wrong');
        }
    }

    public function editEvent(Request $request) {
        $editItem = Events::find($request->id);
        $editItem->title = $request->title;
        $editItem->start = $request->startDate;
        $editItem->end = $request->endDate;
        $editItem->save();
        return back();
    }

    public function deleteEvent(Request $request) {
        $deleteItem = Events::find($request->id);
        $deleteItem->delete();
        return back();
    }
}
