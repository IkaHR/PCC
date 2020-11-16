<?php

namespace App\Http\Controllers;

use App\Act;
use App\CheckRequest\AksesUsaha;
use App\CheckRequest\CekUsaha;
use App\Produk;
use App\Usaha;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ActProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $akses = $this->cekAkses();

        if ($akses == true){

            //ambil semua produk yang sesuai dengan id_usaha di session u
            $produk = Produk::DaftarProduk();
            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

            //redirect ke view tabel produk dengan $datausaha
            //karena relasi act-pro hanya dapat diakses pada laman edit produk
            return view('produks.index', compact('datausaha', 'produk'));
        }

        else if ($akses == false){

            return $this->backHome();

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    protected function validatedData()
    {
        return request()->validate([
            'act_id' => 'required',
            'produk_id' => 'required',
            'frekuensi' => 'required',
        ]);
    }


    protected function cekAkses()
    {
        return app(Pipeline::class)
            ->send(request())
            ->through([
                AksesUsaha::class,
                CekUsaha::class,
            ])
            ->thenReturn();
    }

    protected function backHome()
    {
        return redirect()->route('home')
            ->with('notif', 'Sesi telah berakhir! Silahkan akses menu Data Produk dan yang berkaitan dari Dashboard Badan Usaha Anda');
    }
}
