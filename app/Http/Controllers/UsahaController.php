<?php

namespace App\Http\Controllers;

use App\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsahaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usahas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = request()->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'alamat' => 'nullable',
            'deskripsi' => 'nullable',
        ]);

        Usaha::create($data);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Usaha $usaha)
    {
        $id = Auth::user()->id;
        $user_id = $usaha -> user_id;

        if ($id == $user_id) {
            return view('usahas.edit', compact('usaha'));
        }
        else {
            return ('salah jalan');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Usaha $usaha)
    {
        $data = request()->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'alamat' => 'nullable',
            'deskripsi' => 'nullable',
        ]);

        $usaha->update($data);
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usaha $usaha)
    {
        $usaha->delete();
        return redirect()->route('home');
    }
}
