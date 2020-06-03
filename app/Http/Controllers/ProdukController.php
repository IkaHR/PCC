<?php

namespace App\Http\Controllers;

use App\CheckRequest\RequestSession;
use App\CheckRequest\UsahaSession;
use App\Produk;
use App\Usaha;
use Illuminate\Pipeline\Pipeline;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Produk $produk)
    {
        $akses = $this->cekAkses();

        if ($akses == true){

            $semuausaha = Usaha::DaftarUsaha('id'); //ambil semua id data usaha dari user yang aktif

            //cek apakah id dalam $u ada dalam databasa Table Usaha
            if (!$semuausaha->contains(session('u'))) {
                return abort(404);
            }

            $produk = Produk::DaftarProduk(); //ambil semua produk yang sesuai dengan id_usaha di session u
            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

            //redirect ke view tabel produk dengan $datausaha
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
        $akses = $this->cekAkses();

        if ($akses == true){

            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
            $produk = new produk();
            return view('produks.create', compact('produk', 'datausaha'));
        }

        else if ($akses == false){

            return $this->backHome();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Produk $produk)
    {
        Produk::create($this->validatedData());
        return redirect()->route('produk.index')->with('notif', 'Data Produk/Layanan berhasil disimpan!');
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
        $akses = $this->cekAkses();

        if ($akses == true){

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

        else if ($akses == false){

            return $this->backHome();
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
        return redirect()->route('produk.index')->with('notif', 'Perubahan berhasil disimpan!');
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
        return redirect()->route('produk.index')->with('notif', 'Data Produk/Layanan Berhasil Dihapus!');
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

    protected function cekAkses()
    {
        return app(Pipeline::class)
                ->send(request())
                -> through([
                    RequestSession::class,
                    UsahaSession::class,
                ])
                -> thenReturn();

    }

    protected function backHome()
    {
        return redirect()->route('home')->with('notif', 'Sesi telah berakhir! Silahkan akses menu Produk/Layanan dari Dashboard Badan Usaha Anda');
    }
}
