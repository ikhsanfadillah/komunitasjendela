<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index()
    {
        $mEvents = Event::all();
        return view('pages.events.index',[
            'mEvents' => $mEvents
        ]);
    }

     public function show($id){
        $mEvent = Event::find($id);
        return view('pages.events.edit',['mEvent' => $mEvent]);
    }

    public function create(){
        return view('pages.events.create');
    }

    public function store(Request $request){
        $vEventData = $request->validate(Event::rules());

        DB::beginTransaction();
        try{
            $mEvent = new Event();
            $mEvent->name = $vEventData['name'];
            $mEvent->slug = $vEventData['slug'];
            $mEvent->lat = $vEventData['latitude'];
            $mEvent->long = $vEventData['longitude'];
            $mEvent->radius = 0.3;
            $mEvent->time_type = $vEventData['time_type'];
            $mEvent->day = json_encode($vEventData['day']);
            $mEvent->date = $vEventData['date'];
            $mEvent->time = $vEventData['time'];
            $mEvent->description = $vEventData['description'] ?? "";
            $mEvent->save();
            DB::commit();

            $request->session()->flash('status', 'Successfully create new Event!');
            return redirect()->route('admin.event.index');
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();

        }
        return back();
    }

    public function edit($id){
        $mEvent = Event::find($id);
        return view('pages.events.edit',['mEvent' => $mEvent]);
    }

    public function update(Request $request, $id){
        $vEventData = $request->validate(Event::rules());
        DB::beginTransaction();
        try{
            $mEvent = Event::find($id);
            $mEvent->name = $vEventData['name'];
            $mEvent->slug = $vEventData['slug'];
            $mEvent->lat = $vEventData['latitude'];
            $mEvent->long = $vEventData['longitude'];
            $mEvent->radius = 0.3;
            $mEvent->time_type = $vEventData['time_type'];
            $mEvent->day = isset($vEventData['day']) ? json_encode($vEventData['day']) : NULL;
            $mEvent->date = $vEventData['date'] ?? NULL;
            $mEvent->time = $vEventData['time'];
            $mEvent->description = $vEventData['description'] ?? "";
            $mEvent->save();
            DB::commit();

            $request->session()->flash('status', 'Successfully create new Event!');
            return redirect()->route('admin.event.index');
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();

        }
        return back();
    }

    public function destroy($id){
        // delete
        try {
            $mEvent = Event::find($id);
            $mEvent->delete();
            // redirect
            return redirect()->route('admin.event.index')->with('message', "Successfully deleted the {$mEvent->name}");
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
