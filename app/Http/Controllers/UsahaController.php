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
        //periksa apakah ada parameter u = id_usaha yang dipilih
        if ( ! request()->has('u')){
            return abort(404);
        }
        else{
            //simpan data dari parameter ke variabel
            $u = request('u');
            $semuausaha = Usaha::all('id'); //ambil semua id data usaha dari database

            //cek apakah id dalam $u ada dalam databasa Table Usaha
            if (!$semuausaha->contains($u)) {
                return abort(404);
            }
            else{

                session(['u' => $u]); //simpan data dari variabel ke session
                $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha
                $user_id = $datausaha -> user_id; //ambil user_id dari tabel usaha
                $id = Auth::user()->id; //ambil id dari user aktif

                //periksa apakah user yang aktif memiliki akses ke data usaha
                if ($id != $user_id){
                    return abort(403, 'Unauthorized action.');
                }
                else{
                    //lanjut ke view usahas.edit dengan $usaha & $datausaha untuk sidebar
                    return view('usahas.edit', compact('usaha', 'datausaha'));
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
//        return redirect()->route('home');
        return redirect()->back()->with('notif', 'Data berhasil disimpan!');
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
        return redirect()->route('home')->with('notif', 'Data berhasil dihapus!');
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
