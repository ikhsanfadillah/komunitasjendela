<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $timestamps = false;
    public static function buildTree($parentId = 0) {
        $parents = self::where('parent_id',$parentId)->orderBy('sort','ASC')->get()->toArray();

        foreach ($parents as $i => $element) {
            $children = self::buildTree($element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $parents[$i] = $element;
        }

        return $parents;
    }

    public function getHTML($items)
    {
        $items 	= Menu::orderBy('sort')->get();
        return $this->buildMenu($items);
    }
    public function buildMenu($menu, $parentid = 0)
    {
        $result = null;
        foreach ($menu as $order => $item)
            if ($item->parent_id == $parentid) {
            $result .= "<li class='dd-item' 
                data-id='{$item->id}'
                data-text='{$item->text}'
                data-route='{$item->route}'
                data-icon='{$item->icon}'>
                <div class='nested-list-container'>
                    <div class='dd-handle nested-list-handle'>
                        <span class='mdi mdi-drag'></span>
                    </div>
                    <div class='nested-list-content'>
                        <span>
                            <span class='{$item->icon}'></span>
                            {$item->text} 
                            <span style='margin-left:5px; font-size: 0.8em; font-weight: initial'>
                            ".substr(route($item->route),strlen(url('/')))."</span> 
                        </span>                           
                        <div class='nested-list-buttonsgroup'>
                            <a href='#' class='btn btn-xs btn-outline-primary editMenuItem'>
                                <span class='mdi mdi-pencil'></span></a>
                            <a href='#' class='delete_toggle btn btn-xs btn-outline-warning' rel='{$item->id}'>
                                <span class='mdi mdi-delete-empty'></span></a>
                            
                        </div>
                    </div>
                </div>".$this->buildMenu($menu, $item->id) . "</li>";
            }
        return $result ?  "\n<ol class='dd-list'>\n$result</ol>\n" : null;
    }

}
