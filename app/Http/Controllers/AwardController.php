<?php

namespace App\Http\Controllers;

use App\Award;
use Illuminate\Http\Request;

class AwardController extends Controller
{
    public function getAwards(){
        $awards = Award::all();
        return $awards;
    }
}
