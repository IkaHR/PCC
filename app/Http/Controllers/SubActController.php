<?php

namespace App\Http\Controllers;

use App\Act;
use App\CheckRequest\AksesUsaha;
use App\CheckRequest\CekUsaha;
use App\SubAct;
use App\Usaha;
use Illuminate\Http\Request;
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
                $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
                $act = Act::DaftarActs()->where('id', request('a'))->first();
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
    public function store(Request $request)
    {
        $sub = SubAct::create($this->validatedData());
        return redirect('/act/' . $sub -> act_id . '/edit')->with('notif', 'Data Sub-Aktivitas berhasil disimpan!');

//        $sub = SubAct::create($this->cekData());

//        $this->validate($request, [
//            'act_id' => 'required',
//            'detail' => 'required',
//            'idx' => 'required',
//            'frekuensi' => 'required',
//            'fi' => 'nullable'
//        ]);

//        $sub = SubAct::class();
//        $sub -> act_id = $request -> input('act_id');
//        $sub -> detail = $request -> input('detail');
//        $sub -> idx = $request -> input('idx');
//        $sub -> frekuensi = $request -> input('frekuensi');
//        $sub -> fi = $request -> input('idx') * $request -> input('frekuensi');
//        $sub -> save();

//        $sub = SubAct::class();
//        $sub -> act_id = $request -> act_id;
//        $sub -> detail = $request -> detail;
//        $sub -> idx = $request -> idx;
//        $sub -> frekuensi = $request -> frekuensi;
//        $sub -> fi = $request -> idx * $request -> frekuensi;
//        $sub -> save();
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
    public function edit(SubAct $subAct)
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
            'detail' => 'required',
            'idx' => 'required',
            'frekuensi' => 'required',
            'fi' => 'nullable',
        ]);
    }

//    protected function cekData()
//    {
//        request()->all();
//        request()->fi = request()->input('idx') * request()->input('frekuensi');
//
//        return request()->validate([
//            'act_id' => 'required',
//            'detail' => 'required',
//            'idx' => 'required',
//            'frekuensi' => 'required',
//            'fi' => 'nullable',
//        ]);
//    }

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
