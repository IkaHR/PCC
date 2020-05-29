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
    public function index(Request $request)
    {
        $request->session()->forget('u'); //hapus key session u
        $usaha = Usaha::DaftarUsaha(); //panggil dari Model Usaha.php
        return view('home', compact('usaha'));; //kirim data ke view home.blade.php
    }
}
