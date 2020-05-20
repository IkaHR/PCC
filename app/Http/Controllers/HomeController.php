<?php

namespace App\Http\Controllers;

use App\Usaha;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $arr['usaha'] = Usaha::all();
    	return view('home')->with($arr);
    }
}
