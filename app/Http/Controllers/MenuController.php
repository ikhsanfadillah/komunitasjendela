<?php

namespace App\Http\Controllers;

use App\MasterMenu;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;

class MenuController extends Controller
{
    public function index()
    {
        $mMasterMenus 	= MasterMenu::all();
        return view('pages.menu.index', array('mMasterMenus'=>$mMasterMenus));
    }

    public function edit($id)
    {
        $mMasterMenu = MasterMenu::find($id);
        $items 	= Menu::where('master_menu_id',$id)->orderBy('sort')->get();
        $menu 	= new Menu;
        $menu   = $menu->getHTML($items);

        return view('pages.menu.edit', array('items'=>$items,'menu'=>$menu,'mMasterMenu'=>$mMasterMenu));

    }

    // AJAX Reordering function
    public function reordering(Request $request)
    {
        $source       = $request->id;
        $destination  = $request->parent_id ?: 0;

        $item             = Menu::find($source);
        $item->parent_id  = $destination;
        $item->save();

        $sorting       = $request->sort;
        $rootSorting   = $request->rootSorting;

        if($sorting){
            foreach($sorting as $sort =>$item_id){
                if($itemToOrder = Menu::find($item_id)){
                    $itemToOrder->sort = $sort;
                    $itemToOrder->save();
                }
            }
        } else {
            foreach($rootSorting as $sort=>$item_id){
                if($itemToOrder = Menu::find($item_id)){
                    $itemToOrder->sort = $sort;
                    $itemToOrder->save();
                }
            }
        }
        return response()->json(['success'=>'Got Simple Ajax Request.']);
    }

    public function store(Request $request)
    {
        dd("post");
        DB::beginTransaction();
        try{
            $item = new Menu;
            $item->text 	= $request->text ?: 'untitled';
            $item->icon 	= $request->icon;
            $item->route 	= $request->route;
            $item->sort 	= Menu::max('sort')+1;
            $item->save();
            DB::commit();
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();

        }
        return redirect()->route('admin.menu-builder.index');
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $item = Menu::find($id);
            $item->text 	= $request->text ?: 'untitled';
            $item->icon 	= $request->icon;
            $item->route 	= $request->route;

            $item->save();
            DB::commit();
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();

        }

        return redirect()->route('admin.menu-builder.index');

        return Redirect::to("admin/menu/edit/{$id}");
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try{
            Menu::where('parent_id', $id)->get()->each(function($item)
            {
                $item->parent_id = 0;
                $item->save();
            });

            $item = Menu::find($id);
            $item->delete();
            DB::commit();
        }
        catch (Exception $e){
            DB::rollback();
            return $e->getMessage();
        }

        return redirect()->route('admin.menu-builder.index');
    }
}
