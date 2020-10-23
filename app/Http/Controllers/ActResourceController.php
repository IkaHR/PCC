<?php

namespace App\Http\Controllers;

use App\Act;
use App\CheckRequest\AksesUsaha;
use App\CheckRequest\CekUsaha;
use App\Resource;
use App\Usaha;
use App\ActResource;
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

            //cek query string 'a'
            if (request()->has('a')){

                //ambil daftar id acts yang sesuai dengan sesi usaha
                $acts_usaha = Act::where('usaha_id', session('u'))->get('id');

                //periksa apabila reuest a ada pada daftar id acts
                if ( ! $acts_usaha->contains(request('a')) ){
                    //jika tidak ada, error 404
                    return abort(404);
                }

                //jika ada, lanjut ke view

                //ambil data dari model Usaha yang aktif
                $datausaha = Usaha::usahaAktif();

                //ambil data act yang sedang dipilih
                $act = Act::DataActs()->where('id', request('a'))->first();

                //ambil semua resource yang sesuai dengan id_usaha di session u
                $res = Resource::DaftarResource();

                $act_res = new actresource();

//                dd($res);

                return view('acts.act-res.create', compact('datausaha', 'act', 'res', 'act_res' ));
            }

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
            ->with('notif', 'Sesi telah berakhir! Silahkan akses menu Data Aktivitas dan Resourcenya dari Dashboard Badan Usaha Anda');
    }
}
