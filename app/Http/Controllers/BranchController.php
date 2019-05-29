<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $mBranches = Branch::All();
        return view('pages.branch.index',[
            'mBranches' => $mBranches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.branch.create');

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
            'name' => 'required|max:50'
        ]);
        DB::beginTransaction();
        try{
            $isNewBranch = Branch::withTrashed()->where('name',$vUserData)->first();
            if(empty($isNewBranch))
                Branch::create($vUserData);
            elseif(!empty($isNewBranch))
                $isNewBranch->restore();

            DB::commit();
            $request->session()->flash('status', 'Successfully create new Branch!');
            return redirect()->route('admin.branch.index');
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id){
        $mBranch = Branch::find($id);

        return view('pages.branch.edit',['mBranch' => $mBranch]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mBranch = Branch::find($id);

        return view('pages.branch.edit',['mBranch' => $mBranch]);
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
            'name' => 'required|max:50'
        ]);
        DB::beginTransaction();
        try{
            Branch::find($id)->update($vUserData);
            DB::commit();
            $request->session()->flash('status', 'Successfully Update Branch!');
            return redirect()->route('admin.branch.index');
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        }
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
            $mBranch = Branch::find($id);
            $mBranch->delete();
            // redirect
            return redirect()->route('admin.branch.index')->with('message', "Successfully deleted the {$mBranch->name}!");
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
