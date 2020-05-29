<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Usaha;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //periksa apakah ada parameter u = id_usaha yang dipilih
        if ( ! request()->has('u')){
            return abort(404);
        }
        else{
            //simpan data dari parameter ke variabel
            $u = request('u');
            $semuausaha = Usaha::DaftarUsaha('id'); //ambil semua id data usaha dari user yang aktif

            //cek apakah id dalam $u ada dalam databasa Table Usaha
            if (!$semuausaha->contains($u)) {
                return abort(404);
            }
            else{

                session(['u' => $u]); //simpan data dari variabel ke session
                $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
                $user_id = $datausaha -> user_id; //ambil user_id dari tabel usaha
                $id = Auth::user()->id; //ambil id dari user aktif

                //periksa apakah user yang aktif memiliki akses ke data usaha
                if ($id != $user_id){
                    return abort(403, 'Unauthorized action.');
                }
                else{
                    //redirect ke view tabel produk dengan $datausaha
                    return view('produks.index', compact('datausaha'));
                }

            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
        $produk = new produk();
        return view('produks.create', compact('produk', 'datausaha'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
