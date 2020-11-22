<?php

namespace App\Http\Controllers;

use App\Act;
use App\CheckRequest\AksesUsaha;
use App\CheckRequest\CekUsaha;
use App\Resource;
use App\Usaha;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ActResourceController extends Controller
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

            //redirect ke view tabel act dengan $datausaha
            //karena relasi act-res hanya dapat diakses pada laman edit act
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

            //cek sesi string 'a'
            if (session()->has('a')){

                //ambil daftar id acts yang sesuai dengan sesi usaha
                $acts_usaha = Act::where('usaha_id', session('u'))->pluck('id');

                //periksa apakah act_id dalam string 'a' dimiliki oleh sesi usaha yang aktif
                if ( ! $acts_usaha->contains(session('a')) ){
                    //jika tidak, error 404
                    return abort(404);
                }

                //jika ada string 'a', lanjut ke view

                //ambil data dari model Usaha yang aktif
                $datausaha = Usaha::usahaAktif();

                //ambil data act yang sedang dipilih
                $act = Act::DataActs()->where('id', session('a'))->first();

                /*
                 * ambil data resource yang belum disambungkan dengan Act aktif
                 * act_id berdasarkan sesi 'a'
                */

                $resource = Resource::ResourcesUntukAct();

                return view('acts.act-res.create', compact('datausaha', 'act', 'resource'));
            }

            // jika tidak ada string 'a'
            return redirect()->route('acts.index')
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
        $this->validatedData();

        $act_id = request()->act_id;
        $resource_id = request()->resource_id;
        $input_kuantitas = request()->kuantitas;

        $act = Act::where('id', $act_id)->first();
        $resource = Resource::where('id', $resource_id)->first();

        if ($input_kuantitas > $resource->kuantitas){

            // jika kuantitas yang diinputkan lebih besar dari yang dimiliki resource
            // maka operasi akan dibatalkan
            return back()
                ->with('warning', 'Kuantitas tidak boleh melebihi jumlah yang tersedia!');

        }

        $act->resources()->syncWithoutDetaching([
            $resource_id => [
                'kuantitas' => $input_kuantitas
            ]
        ]);

        return redirect('/acts/'.$act->id.'/edit')
            ->with('success', 'Resource berhasil ditambahkan ke data Aktivitas!');
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
        $act_id = request()->act_id;
        $resource_id = request()->resource_id;

        $act = Act::where('id', $act_id)->first();

        $act->resources()->detach($resource_id);

        return redirect()->to('/acts/'.$act->id.'/edit')
            ->with('success', 'Resource sudah tidak terhubung dengan data Aktivitas ini!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'act_id' => 'required',
            'resource_id' => 'required',
            'kuantitas' => 'required',
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
            ->with('notif', 'Sesi telah berakhir! Silahkan akses menu Data Aktivitas dan yang berkaitan dari Dashboard Badan Usaha Anda');
    }
}
