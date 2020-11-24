<?php

namespace App\Http\Controllers;

use App\Usaha;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('sesi.end')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

        //redirect ke view tabel produk dengan $datausaha
        return view('dashboard', compact('datausaha'));

    }
}
