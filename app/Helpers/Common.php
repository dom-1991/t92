<?php
namespace App\Helpers;

class Common {
    public static function getClientIp ()
    {
        return request()->getClientIp();
    }
}
