<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Gettheme extends Controller
{
    public function getShowPage($page){

        return view('theme.'.$page);
    }
}
