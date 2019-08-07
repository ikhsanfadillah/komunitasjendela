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
        DB::beginTransaction();
        try{
            $mEvent = new Event();
            $mEvent->name = $request->name;
            $mEvent->slug = $request->slug;
            $mEvent->time_type = $request->time_type;
            $mEvent->day = json_encode($request->day);
            $mEvent->date = $request->date;
            $mEvent->time = $request->time;
            $mEvent->description = $request->description;
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
        $request->merge([
            'nik' => str_replace(' ','',$request->nik),
            'phone' => str_replace(' ','',$request->phone),
            'password' => bcrypt('Jendela'.date('dmy', strtotime($request->dob)))
        ]);
        $vEventData = $request->validate(Event::rules($id),[
            'city_id.required' => "You have to choose the City that ".($request->gender == 'M'? 'He' : 'She')." live in",
            'city_id.exists' => "Sorry, the City does not exists"
        ]);
        DB::beginTransaction();
        try{

            Event::find($id)->update($vEventData);

            if(Event::find($id)->detail)
                EventDetail::find($id)->update($vEventData);
            else
                EventDetail::create(array_merge($vEventData,['user_id' => $id]));

            DB::commit();
            $request->session()->flash('status', 'Successfully created Event!');
            return redirect()->route('admin.event.index');
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
        return back();

        $mEvent = Event::find($id);
        $cities = City::All();
        return view('pages.event.edit',['mEvent' => $mEvent]);
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
