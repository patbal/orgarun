<?php
/**
 * Created by PhpStorm.
 * User: patbal
 * Date: 23/03/2018
 * Time: 23:47
 */

namespace App\Service;


class telFormat
{
    public function formatel(string $num)
    {
        $num = trim($num);
        $num = str_replace('-', '', $num);
        $num = str_replace('.', '', $num);
        $num = str_replace('+33', '0', $num);

        $tel = '+33 '.substr($num, 1,1).' '.substr($num, 2, 2).' '
            .substr($num, 4, 2).' '.substr($num, 6, 2)
            .' '.substr($num, 8, 2);

        return($tel);

    }
}
