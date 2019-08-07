<?php

namespace App\Http\Controllers;

use App\Models\Subbranch;
use App\Models\Event;
use App\Models\User;
use App\Models\VolunteerAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class VolunteerAttendanceController extends Controller
{
    public function index(){
        $mVolunteerAttendances = VolunteerAttendance::paginate(20);
        return view('pages.attendance.volunteer.index',['mVolunteerAttendances' => $mVolunteerAttendances]);
    }

    public function attend(Request $request){
        $vVolAttendance = $request->validate(VolunteerAttendance::rules());
        $hasAbsen = VolunteerAttendance::where('user_id',Auth::id())
            ->where('subbranch_id',$vVolAttendance['subbranch'])
            ->where('date',date('Y-m-d'))->first();
        if($hasAbsen){
            return redirect()->back()->with($this->flashMessage('danger','cannot present twice in the same day and same location'));
        }
        DB::beginTransaction();
        try{
            $mSubbranch = Subbranch::find($vVolAttendance['subbranch']);

            $mVolAttendance = new VolunteerAttendance();
            $mVolAttendance->user_id = Auth::id();
            $mVolAttendance->checker_id = null;
            $mVolAttendance->subbranch_id = $vVolAttendance['subbranch'];
            $mVolAttendance->status = 1;
            $mVolAttendance->date = date('Y-m-d');
            $mVolAttendance->time_in = date('H:i:s');
            $mVolAttendance->time_out = date('H:i:s');
            $mVolAttendance->save();
            DB::commit();

            return redirect()->back();
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();

        }
        return redirect()->back()->with($this->flashMessage('error','Successfully Present In Perpus '.$mSubbranch->name));
    }
    public function multiple(Request $request)
    {
        foreach ($request->volunteers as $volunteer) {
            $mVolAttendance = VolunteerAttendance::where('subbranch_id',$request->subbranch)
                ->where('user_id',$volunteer)->where('date',$request->date)->first();
            if(empty($mVolAttendance)){
                DB::beginTransaction();
                    try{
                        $mVolAttendance = new VolunteerAttendance();
                        $mVolAttendance->user_id = $volunteer;
                        $mVolAttendance->checker_id = Auth::id();
                        $mVolAttendance->subbranch_id = $request->subbranch;
                        $mVolAttendance->status = 1;
                        $mVolAttendance->date = date('Y-m-d');
                        $mVolAttendance->time_in = date('H:i:s');
                        $mVolAttendance->time_out = date('H:i:s');
                        $mVolAttendance->save();
                        DB::commit();
        
                    }
                    catch (Exception $e){
                        DB::rollback();
                        return $e->getMessage();
        
                    }
                    # code...
            }
        }
        return redirect()->back()->with($this->flashMessage('success','Successfully insert attendaces'));
    }
    public function selfAttending(Request $request){
        $mVolunteer = User::with('detail')
            ->whereHas('detail', function($query) use ($request){
                $query->where('phone', '=', str_replace(' ', '', $request->phone));
            })->first();
        if(empty($mVolunteer) || !Hash::check($request->password, $mVolunteer->password))
            return redirect()->back()->with($this->flashMessage('error','incorrect phone number or password'));

        $hasAbsen = VolunteerAttendance::where('user_id',$mVolunteer->id)
            ->where('event_id',$request->event_id)
            ->where('date',date('Y-m-d'))->first();
        if($hasAbsen){
            return redirect()->back()->with($this->flashMessage('error','Cannot present twice in the same day and same location'));
        }
        DB::beginTransaction();
        try{
            $mVolAttendance = new VolunteerAttendance();
            $mVolAttendance->user_id = $mVolunteer->id;
            $mVolAttendance->checker_id = null;
            $mVolAttendance->event_id = $request->event_id;
            $mVolAttendance->status = 1;
            $mVolAttendance->date = date('Y-m-d');
            $mVolAttendance->long = $request->long;
            $mVolAttendance->lat = $request->lat;
            $mVolAttendance->time_in = date('H:i:s');
            $mVolAttendance->time_out = date('H:i:s');
            $mVolAttendance->save();
            DB::commit();

            return redirect()->back()->with($this->flashMessage('success','Successfully record your presence '));
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();

        }
        return redirect()->back()->with($this->flashMessage('error','terjadi kesalahan. mohon coba kembali'));
    }
    public function destroy($id){
        // delete
        dd($id);
        DB::beginTransaction();
        try {
            $mVolAttendance = VolunteerAttendance::find($id);
            $mVolAttendance->delete();
            DB::commit();
            // redirect
            return redirect()->route('admin.volunteer-attendance.index')->with($this->flashMessage('success', "Successfully deleted the {$mVolAttendance->name}"));
        }
        catch (\Exception $e) {
            DB::rollback();
            return $e->getMessage();
        }
    }

    public function eventAttend($slug)
    {
        $mEvent = Event::where('slug',$slug)->firstOrFail();

        return view('pages.attendance.volunteer.event-attendance',['mEvent' => $mEvent]);
    }
}
