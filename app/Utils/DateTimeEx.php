<?php
/**
 * Created by PhpStorm.
 * User: Jonathan
 * Date: 03/11/2018
 * Time: 17:02
 */

namespace App\Utils;


class DateTimeEx
{
    public static function minToHoraMin($min)
    {
        return gmdate("H:i", ($min * 60));
    }

    public static function horaMinToMin($hora)
    {
        $arr = explode(':', $hora);
        $h = intval($arr[0]) * 60;
        $m = intval($arr[1]);
        return intval($h + $m);

       /* $arr = explode (':', $hora);
        $dec = intval (($arr[1]/6)*10);

        return ceil((floatval(
                intval($arr[0]) . ',' . ($dec < 10 ? '0' : '') + $dec))
                * 60);*/

        //return ceil(floatval(date('H.i', strtotime($hora))) * 60);
    }

}
