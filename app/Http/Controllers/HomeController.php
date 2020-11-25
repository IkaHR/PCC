<?php

namespace App\Http\Controllers;

use App\Usaha;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('sesi.end')->only(['index']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        session()->forget('u'); //hapus key session u

        $usaha = Usaha::DaftarUsaha(); //panggil dari Model Usaha.php
        return view('home', compact('usaha')); //kirim data ke view home.blade.php
    }
}
