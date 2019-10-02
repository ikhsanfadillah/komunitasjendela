<?php
namespace App\Helpers;

class App
{
    /**
     * @param $time
     * @return false|string
     */
    public static function formatTime($time){
        return date("g:i a", strtotime($time));
    }

}