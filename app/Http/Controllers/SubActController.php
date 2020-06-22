<?php

namespace App\Http\Controllers;

use App\Act;
use App\CheckRequest\AksesUsaha;
use App\CheckRequest\CekUsaha;
use App\SubAct;
use App\Usaha;
use Illuminate\Pipeline\Pipeline;

class SubActController extends Controller
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

            //ambil semua act yang sesuai dengan id_usaha di session u
            $act = Act::DaftarActs();
            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

            //redirect ke view tabel produk dengan $datausaha
            return view('acts.index', compact('datausaha', 'act'));
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

            //cek query string 'a'
            if (request()->has('a')){

                //ambil daftar id acts yang sesuai dengan sesi usaha
                $acts_usaha = Act::where('usaha_id', session('u'))->get('id');

                //periksa apabila reuest a ada pada daftar id acts
                if ( ! $acts_usaha->contains(request('a'))){
                    //jika tidak ada, error 404
                    return abort(404);
                }

                //jika ada, lanjut ke view
                $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
                $act = Act::DataActs()->where('id', request('a'))->first();
                $sub = new subAct();

                return view('subs.create', compact('sub', 'datausaha', 'act'));
            }

            return redirect()->route('act.index')
                             ->with('notif', 'Sesi terputus! silahkan pilih kembali aktivitas yang ingin diatur. ');
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
        $sub = SubAct::create($this->validatedData());
        return redirect('/act/' . $sub -> act_id . '/edit')->with('notif', 'Data Sub-Aktivitas berhasil disimpan!');
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
    public function edit(SubAct $sub)
    {
        $akses = $this->cekAkses();

        if ($akses == true){

            if (request()->has('a')){

                //ambil id act dari subAct yang dipilih
                $id_act = $sub -> act_id;

                //periksa apakah query a telah sesuai dengan id_act yang dipilih
                if ($id_act != request('a')){
                    return abort(403, 'Unauthorized action.');
                }

                $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
                $act = Act::DataActs()->where('id', request('a'))->first();
                return view('subs.edit', compact('sub', 'datausaha', 'act'));
            }

            return redirect()->route('act.index')
                ->with('notif', 'Sesi terputus! silahkan pilih kembali aktivitas yang ingin diatur. ');
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
    public function update(SubAct $sub)
    {
        $sub -> update($this->validatedData());
        return redirect('/act/' . $sub -> act_id . '/edit')->with('notif', 'Data Sub-Aktivitas berhasil diedit!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubAct $sub)
    {
        $sub -> delete();
        return redirect('/act/' . $sub -> act_id . '/edit')->with('notif', 'Data Sub-Aktivitas berhasil dihapus!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'act_id' => 'required',
            'detail' => 'required',
            'idx' => 'required',
            'frekuensi' => 'required',
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
        return redirect()->route('home')->with('notif', 'Sesi telah berakhir! Silahkan akses menu Data Aktivitas dan Sub-Aktivitas dari Dashboard Badan Usaha Anda');
    }
}
