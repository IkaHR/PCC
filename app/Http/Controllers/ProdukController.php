<?php

namespace App\Http\Controllers;

use App\Act;
use App\Produk;
use App\Usaha;
use App\Events\PelaporanBiayaProdukEvent;
use PDF;

class ProdukController extends Controller
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
        $produk = Produk::DaftarProduk(); //ambil semua produk yang sesuai dengan id_usaha di session u
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

        //redirect ke view tabel produk dengan $datausaha
        return view('produks.index', compact('datausaha', 'produk'));
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
    public function store()
    {
        $produk = Produk::create($this->validatedData());

        return redirect()->to('/produks/'.$produk->id.'/edit')
            ->with('success', 'Silahkan tambahkan Aktivitas dan Pengeluaran Langsung yang berhubungan');
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
    public function edit(Produk $produk)
    {
        // simpan id produk ke sesi 'p'
        session(['p' => $produk->id]);

        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
        $usaha_id = $datausaha -> id; //ambil id dari usaha aktif
        $usaha_key = $produk -> usaha_id; //ambil foreign key usaha_id dari tabel produk

        //cek apakah user yang aktif memiliki akses ke data usaha ini
        if ($usaha_key !== $usaha_id){
            return abort(403, 'Unauthorized action.');
        }
        else{
            //redirect ke view tabel produk dengan $datausaha
            return view('produks.edit', compact('datausaha', 'produk'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Produk $produk)
    {
        $produk->update($this->validatedData());
        return redirect()->route('produks.index')->with('success', 'Perubahan berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produks.index')->with('success', 'Data Produk/Layanan Berhasil Dihapus!');
    }

    public function laporan(Produk $produk)
    {
        // simpan id produk ke sesi 'p'
        session(['p' => $produk->id]);

        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
        $act_produk = Act::ActUntukLaporan(); //ambil data Act yang terhubung dengan produk ini

        event(new PelaporanBiayaProdukEvent($produk->id));

        $data = ['datausaha' => $datausaha,
                'produk' => $produk,
                'act_produk' => $act_produk,
            ];

        $pdf = PDF::loadview('produks.laporan', $data);
        $pdf2 = PDF::loadview('report', $data);

        $filename = $produk->nama.'_'.date('d-m-Y').'.pdf';

        return $pdf2->download($filename);

//        return view('produks.laporan', compact('datausaha', 'produk', 'act_produk'));
    }

    protected function validatedData()
    {
        return request()->validate([
            'usaha_id' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'deskripsi' => 'nullable',
        ]);
    }
}
