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
        $usaha['usaha'] = Usaha::where('user_id', Auth::user()->id)->get(); //ambil data usaha yang sesuai dengan ID user aktif

        return view('home')->with($usaha); //kirim data ke view home.blade.php
    }
}
