<?php

namespace App\Http\Controllers;

use App\Models\Subbranch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubbranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $mSubbranches = Subbranch::with('branch')->get();
        return view('pages.subbranch.index',[
            'mSubbranches' => $mSubbranches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.subbranch.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $vUserData = $request->validate([
            'name' => 'required|max:50',
            'branch_id' => 'required|exists:branches,id'
        ],[
            'subbranch_id.required' => "You have to choose the Branch that live in",
            'subbranch_id.exists' => "The Branch does not exists",
        ]);
        DB::beginTransaction();
        try{
            $isNewSubbranch = Subbranch::withTrashed()
                ->where('name',$vUserData['name'])->where('branch_id',$vUserData['branch_id'])->first();
            if(empty($isNewSubbranch))
                Subbranch::create($vUserData);
            elseif(!empty($isNewSubbranch))
                $isNewSubbranch->restore();

            DB::commit();
            $request->session()->flash('status', 'Successfully create new Subbranch!');
            return redirect()->route('admin.subbranch.index');
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id){
        $mSubbranch = Subbranch::find($id);

        return view('pages.subbranch.edit',['mSubbranch' => $mSubbranch]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mSubbranch = Subbranch::find($id);

        return view('pages.subbranch.edit',['mSubbranch' => $mSubbranch]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $vUserData = $request->validate([
            'name' => 'required|max:50',
            'branch_id' => 'required|exists:subbranches,id'
        ],[
            'subbranch_id.required' => "You have to choose the Branch that live in",
            'subbranch_id.exists' => "The Branch does not exists",
        ]);

        DB::beginTransaction();
        try{
            Subbranch::find($id)->update($vUserData);
            DB::commit();
            $request->session()->flash('status', 'Successfully Update Subbranch!');
            return redirect()->route('admin.subbranch.index')->with([
                'alert-type' => 'success',
                'alert-message' => 'Successfully Update Subbranch!']);
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
        dd("test");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        // delete
        try {
            $mSubbranch = Subbranch::find($id);
            $mSubbranch->delete();
            // redirect
            return redirect()->route('admin.subbranch.index')->with('message', "Successfully deleted the {$mSubbranch->name}!");
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
