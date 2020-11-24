<?php

namespace App\Http\Controllers;

use App\Usaha;
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
        $usaha = new Usaha();
        return view('usahas.create', compact('usaha'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Usaha::create($this->validatedData());
        return redirect()->route('home')->with('success', 'Data Perusahaan berhasil disimpan!');
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
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
        $id = Auth::user()->id; //ambil id dari user aktif
        $user_id = $usaha -> user_id; //ambil user_id dari tabel usaha

        //cek apakah user yang aktif memiliki akses ke data usaha ini
        if ($id !== $user_id){
            return abort(403, 'Unauthorized action.');
        }
        else{
            //redirect ke view tabel produk dengan $datausaha
            return view('usahas.edit', compact('datausaha', 'usaha'));
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
        $usaha->update($this->validatedData());
        return redirect()->back()->with('success', 'Perubahan berhasil disimpan!');
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
        return redirect()->route('home')->with('success', 'Data badan usaha berhasil dihapus!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable|email',
            'alamat' => 'nullable',
            'deskripsi' => 'nullable',
        ]);
    }
}
