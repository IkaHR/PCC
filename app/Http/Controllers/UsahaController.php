<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsahaController extends Controller
{
    public function index()
    {
        $pagename = 'Profil Usaha';
        return view('usahas.show', compact("pagename"));
    }
}
