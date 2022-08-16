<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Test extends Controller
{
    //

    public function test()
    {
        $func = fn(int $x, int $y): int => $x + $y;

//        $func = fn(
//            int $x,
//            int $y,
//        ): int => $x + $y;

        $a = $func(3, 5);


    }
}
