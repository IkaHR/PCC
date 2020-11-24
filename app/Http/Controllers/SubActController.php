<?php

namespace App\Http\Controllers;

use App\Act;
use App\SubAct;
use App\Usaha;
use Illuminate\Http\Request;

class SubActController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //ambil semua act yang sesuai dengan id_usaha di session u
        $act = Act::DaftarActs();
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

        //redirect ke view tabel act dengan $datausaha
        //karena tabel sub hanya dapat diakses pada laman edit act
        return view('acts.index', compact('datausaha', 'act'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //cek query string 'a'
        if (session()->has('a')){

            //jika ada, lanjut ke view
            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
            $act = Act::DataActs()->where('id', session('a'))->first();
            $sub = new subAct();

            return view('acts.subs.create', compact('sub', 'datausaha', 'act'));
        }

        return redirect()->route('acts.index')
            ->with('notif', 'Sesi terputus! silahkan pilih kembali aktivitas yang ingin diatur. ');
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
        return redirect('/acts/' . $sub -> act_id . '/edit')
            ->with('success', 'Data Sub-Aktivitas berhasil disimpan!');
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
        if (session()->has('a')){

            //ambil id act dari subAct yang dipilih
            $id_act = $sub -> act_id;

            //periksa apakah query a telah sesuai dengan id_act yang dipilih
            if ($id_act != session('a')){
                return abort(403, 'Unauthorized action.');
            }

            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
            $act = Act::DataActs()->where('id', session('a'))->first();
            return view('acts.subs.edit', compact('sub', 'datausaha', 'act'));
        }

        return redirect()->route('acts.index')
            ->with('error', 'Sesi terputus! silahkan pilih kembali aktivitas yang ingin diatur. ');
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
        return redirect('/acts/' . $sub -> act_id . '/edit')
            ->with('success', 'Data Sub-Aktivitas berhasil diedit!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $sub = SubAct::findOrFail($request->id);

        $sub -> delete();
        return redirect('/acts/' . $sub -> act_id . '/edit')->with('success', 'Data Sub-Aktivitas berhasil dihapus!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'act_id' => 'required',
            'detail' => 'required',
            'idx' => 'required',
        ]);
    }
}
