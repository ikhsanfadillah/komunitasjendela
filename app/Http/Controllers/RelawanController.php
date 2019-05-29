<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\City;
use App\Models\Userdetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Session;


class RelawanController extends Controller
{
    public function index(){
        $mRelawans = User::All();
        return view('pages.relawan.index',[
            'mRelawans' => $mRelawans
        ]);
    }

    public function show($id){
        $mRelawan = User::find($id);

        return view('pages.relawan.edit',['mRelawan' => $mRelawan]);
    }

    public function create(){
        return view('pages.relawan.create');
    }

    public function store(Request $request){

        $request->merge([
            'nik' => str_replace(' ','',$request->nik),
            'phone' => str_replace(' ','',$request->phone),
            'password' => bcrypt('Jendela'.date('dmy', strtotime($request->dob)))
            ]);

        $vUserData = $request->validate(User::rules());
        DB::beginTransaction();
        try{
            $mUser = User::create($vUserData);
            UserDetail::create(array_merge($vUserData,['user_id' => $mUser->id]));
            DB::commit();

            $request->session()->flash('status', 'Successfully create new Relawan!');
            return redirect()->route('admin.relawan.index');
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();

        }
        return back();
    }

    public function edit($id){
        $mRelawan = User::find($id);
        return view('pages.relawan.edit',['mRelawan' => $mRelawan]);
    }

    public function update(Request $request, $id){
        $request->merge([
            'nik' => str_replace(' ','',$request->nik),
            'phone' => str_replace(' ','',$request->phone),
            'password' => bcrypt('Jendela'.date('dmy', strtotime($request->dob)))
        ]);
        $vUserData = $request->validate(User::rules($id),[
            'city_id.required' => "You have to choose the City that ".($request->gender == 'M'? 'He' : 'She')." live in",
            'city_id.exists' => "Sorry, the City does not exists"
        ]);
        DB::beginTransaction();
        try{

            User::find($id)->update($vUserData);

            if(User::find($id)->detail)
                UserDetail::find($id)->update($vUserData);
            else
                UserDetail::create(array_merge($vUserData,['user_id' => $id]));

            DB::commit();
            $request->session()->flash('status', 'Successfully created Relawan!');
            return redirect()->route('admin.relawan.index');
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
        return back();

        $mRelawan = User::find($id);
        $cities = City::All();
        return view('pages.relawan.edit',['mRelawan' => $mRelawan]);
    }

    public function destroy($id){
        // delete
        try {
            $mUser = User::find($id);
            $mUser->delete();
            // redirect
            return redirect()->route('admin.relawan.index')->with('message', "Successfully deleted the {$mUser->name}");
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
