<?php

namespace App\Http\Controllers;

use App\DirectExp;
use App\Produk;
use App\Usaha;
use Illuminate\Http\Request;

class DirectExpProdukController extends Controller
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
        //karena relasi direct-pro hanya dapat diakses pada laman edit produk
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
            $direct = DirectExp::DirectUntukProduk();

            return view('produks.direct-exps.create', compact('datausaha', 'produk', 'direct') );

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
        $direct_id = request()->direct_id;
        $input_kuantitas = request()->kuantitas;

        $produk = Produk::where('id', $produk_id)->first();

        $produk->directs()->syncWithoutDetaching([
            $direct_id => [
                'kuantitas' => $input_kuantitas
            ]
        ]);

        return redirect()->to('/produks/'.$produk->id.'/edit')
            ->with('success', 'Data Pengeluaran Langsung berhasil ditambahkan ke data Produk');
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
        $direct_id = request()->direct_id;

        $produk = Produk::where('id', $produk_id)->first();

        $produk->directs()->detach($direct_id);

        return redirect()->to('/produks/'.$produk->id.'/edit')
            ->with('success', 'Data Pengeluaran sudah tidak terhubung dengan data Produk ini!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'direct_id' => 'required',
            'produk_id' => 'required',
            'kuantitas' => 'required',
        ]);
    }
}
