<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    public function index(){
        $mStudents = Student::All();
        return view('pages.student.index',[
            'mStudents' => $mStudents
        ]);
    }

    public function show($id){
        $mStudent = Student::find($id);

        return view('pages.student.edit',['mStudent' => $mStudent]);
    }

    public function create(){
        return view('pages.student.create');
    }

    public function store(Request $request){

        $request->merge([
            'nik' => str_replace(' ','',$request->nik),
            'phone' => str_replace(' ','',$request->phone),
        ]);
        $vStudentData = $request->validate(Student::rules(),[
            'city_id.required' => "You have to choose the City that ".($request->gender == 'M'? 'He' : 'She')." live in",
            'city_id.exists' => "Sorry, the City does not exists"
        ]);
        DB::beginTransaction();
        try{
            $mStudent = Student::create($vStudentData);
            DB::commit();

            $request->session()->flash('success', "Successfully create student!");
            return redirect()->route('admin.student.index');
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
        return back();
    }

    public function edit($id){
        $mStudent = Student::find($id);
        return view('pages.student.edit',['mStudent' => $mStudent]);
    }

    public function update(Request $request, $id){
        $request->merge([
            'nik' => str_replace(' ','',$request->nik),
            'phone' => str_replace(' ','',$request->phone),
            'password' => bcrypt('Jendela'.date('dmy', strtotime($request->dob)))
        ]);
        $vStudentData = $request->validate(Student::rules($id),[
            'city_id.required' => "You have to choose the City that ".($request->gender == 'M'? 'He' : 'She')." live in",
            'city_id.exists' => "Sorry, the City does not exists"
        ]);
        DB::beginTransaction();
        try{

            Student::find($id)->update($vStudentData);

            DB::commit();
            $request->session()->flash('success', 'Successfully created Student!');
            return redirect()->route('admin.student.index');
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
        return back();

        $mStudent = Student::find($id);
        $cities = City::All();
        return view('pages.student.edit',['mStudent' => $mStudent]);
    }

    public function destroy($id){
        // delete
        try {
            $mStudent = Student::find($id);
            $mStudent->delete();
            // redirect
            return redirect()->route('admin.student.index')->with('message', "Successfully deleted student : {$mStudent->name}");
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
