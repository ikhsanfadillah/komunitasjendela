<?php

namespace App\Models;


class Flashmessage
{
    public static $alertTypeList = ["success" => "success", "danger" => "danger","warning","warning","info","info"];
    public static $SUCCESS = 'success';
    public static $DANGER = 'danger';
    public static $WARNING = 'warning';
    public static $INFO = 'info';

    public static function setFlash($alertType, $alertMessage)
    {
        return [
            'alert-type' => $alertType,
            'alert-message' => $alertMessage
        ];
    }
}
