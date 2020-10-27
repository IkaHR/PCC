<?php

namespace App\Http\Controllers;

use App\CheckRequest\AksesUsaha;
use App\CheckRequest\CekUsaha;
use App\DirectExp;
use App\Usaha;
use Illuminate\Pipeline\Pipeline;

class DirectExpController extends Controller
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

            //ambil semua direct-exps yang sesuai dengan id_usaha di session u
            $directExp = DirectExp::DaftarDirectExps();
            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

            //redirect ke view tabel produk dengan $datausaha
            return view('direct-exps.index', compact('datausaha', 'directExp'));
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
            $directExp = new DirectExp();
            return view('direct-exps.create', compact('directExp', 'datausaha'));
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
    public function store()
    {
        DirectExp::create($this -> validatedData());
        return redirect()->route('direct-exps.index')->with('success', 'Data Pengeluaran Langsung berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DirectExp  $directExp
     * @return \Illuminate\Http\Response
     */
    public function show(DirectExp $directExp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DirectExp  $directExp
     * @return \Illuminate\Http\Response
     */
    public function edit(DirectExp $directExp)
    {
        $akses = $this->cekAkses();

        if ($akses == true){

            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
            $usaha_id = $datausaha -> id; //ambil id dari usaha aktif
            $usaha_key = $directExp -> usaha_id; //ambil foreign key usaha_id dari tabel direct-exps

            //cek apakah user yang aktif memiliki akses ke data usaha ini
            if ($usaha_key !== $usaha_id){
                return abort(403, 'Unauthorized action.');
            }
            else{
                //redirect ke view edit direct-exps dengan $datausaha
                return view('direct-exps.edit', compact('datausaha', 'directExp'));
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
     * @param  \App\DirectExp  $directExp
     * @return \Illuminate\Http\Response
     */
    public function update(DirectExp $directExp)
    {
        $directExp -> update($this -> validatedData());
        return redirect()->route('direct-exps.index')->with('success', 'Perubahan berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DirectExp  $directExp
     * @return \Illuminate\Http\Response
     */
    public function destroy(DirectExp $directExp)
    {
        $directExp -> delete();
        return redirect()->route('direct-exps.index')->with('success', 'Data berhasil dihapus!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'usaha_id' => 'required',
            'nama' => 'required',
            'biaya' => 'required',
            'deskripsi' => 'nullable',
        ]);
    }

    protected function cekAkses()
    {
        return app(Pipeline::class)
            ->send(request())
            -> through([
                AksesUsaha::class,
                CekUsaha::class,
            ])
            -> thenReturn();
    }

    protected function backHome()
    {
        return redirect()->route('home')->with('notif', 'Sesi telah berakhir! Silahkan akses menu Data Pengeluaran Langsung dari Dashboard Badan Usaha Anda');
    }
}
