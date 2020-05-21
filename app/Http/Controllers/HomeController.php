<?php

namespace App\Http\Controllers;

use App\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $usaha['usaha'] = Usaha::where('user_id', $id)->get();
        return view('home')->with($usaha);
    }
}
