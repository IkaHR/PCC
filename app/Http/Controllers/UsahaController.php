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
        $usaha = new Usaha();
        return view('usahas.create', compact('usaha'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Usaha::create($this->validatedData());
        return redirect()->route('home')->with('notif', 'Data Perusahaan berhasil disimpan!');
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
        //periksa apakah ada parameter u = id_usaha yang dipilih
        if ( ! request()->has('u')){

            //cek sesi apakah memiliki u
            $cek_sesi = session()->has('u');

            //jika sesi tidak memiliki u, batalkan operasi
            if ($cek_sesi == false){
                return abort(404);
            }

            else{

                $datausaha = $usaha;
                $user_id = $datausaha -> user_id; //ambil user_id dari tabel usaha
                $id = Auth::user()->id; //ambil id dari user aktif

                //cek apakah user yang aktif memiliki akses ke data usaha ini
                if ($id !== $user_id){
                    return abort(403, 'Unauthorized action.');
                }
                else{
                    //redirect ke view tabel produk dengan $datausaha
                    return view('usahas.edit', compact('datausaha', 'usaha'));
                }
            }
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
        return redirect()->back()->with('notif', 'Perubahan berhasil disimpan!');
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
        return redirect()->route('home')->with('notif', 'Data badan usaha berhasil dihapus!');
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
