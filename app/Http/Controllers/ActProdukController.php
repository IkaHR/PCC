<?php

namespace App\Http\Controllers;

use App\Act;
use App\Produk;
use App\Usaha;
use Illuminate\Http\Request;

class ActProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ambil semua produk yang sesuai dengan id_usaha di session u
        $produk = Produk::DaftarProduk();
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

        //redirect ke view tabel produk dengan $datausaha
        //karena relasi act-pro hanya dapat diakses pada laman edit produk
        return view('produks.index', compact('datausaha', 'produk'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //cek sesi string 'p'
        if (session()->has('p')){

            //ambil data dari model Usaha yang aktif
            $datausaha = Usaha::usahaAktif();

            //ambil data produk yang sedang dipilih
            $produk = Produk::DaftarProduk()->where('id', session('p'))->first();

            // ambil data act yang belum tersambung dengan produk yang aktif
            // produk_id berdasarkan sesi 'p'
            $act = Act::ActUntukProduk();

            return view('produks.acts.create', compact('datausaha', 'produk', 'act') );

        }

        // jika tidak ada string 'p'
        return redirect()->route('produks.index')
            ->with('notif', 'Sesi terputus! silahkan pilih kembali produk yang ingin diatur. ');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validatedData();

        $produk_id = request()->produk_id;
        $act_id = request()->act_id;
        $input_frekuensi = request()->frekuensi;

        $produk = Produk::where('id', $produk_id)->first();

        $produk->acts()->syncWithoutDetaching([
            $act_id => [
                'frekuensi' => $input_frekuensi
            ]
        ]);

        return redirect()->to('/produks/'.$produk->id.'/edit')
            ->with('success', 'Aktivitas berhasil ditambahkan ke data Produk');

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
    public function destroy()
    {
        $produk_id = request()->produk_id;
        $act_id = request()->act_id;

        $produk = Produk::where('id', $produk_id)->first();

        $produk->acts()->detach($act_id);

        return redirect()->to('/produks/'.$produk->id.'/edit')
            ->with('success', 'Aktivitas sudah tidak terhubung dengan data Produk ini!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'act_id' => 'required',
            'produk_id' => 'required',
            'frekuensi' => 'required',
        ]);
    }
}
