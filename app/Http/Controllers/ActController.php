<?php

namespace App\Http\Controllers;

use App\Act;
use App\Events\ActBaruDitambahkanEvent;
use App\SubAct;
use App\Usaha;

class ActController extends Controller
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

        //ambil semua act yang sesuai dengan id_usaha di session u
        $act = Act::DataActs();
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

        //redirect ke view tabel produk dengan $datausaha
        return view('acts.index', compact('datausaha', 'act'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
        $act = new act();

        return view('acts.create', compact('act', 'datausaha'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $act = Act::create($this->validatedData());

        event(new ActBaruDitambahkanEvent($act));

        return redirect()->to('/acts/'.$act->id.'/edit')
            ->with('notif', 'Silahkan tambahkan Sub-Aktivitas dan Resource yang aktif');
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
    public function edit(Act $act)
    {
        // simpan id act ke sesi 'a'
        session(['a' => $act->id]);

        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
        $usaha_id = session('u'); //ambil id dari usaha aktif di sesi 'u'
        $usaha_key = $act -> usaha_id; //ambil foreign key usaha_id dari tabel act

        //cek apakah user yang aktif memiliki akses ke data usaha ini
        if ($usaha_key != $usaha_id){
            return abort(403, 'Unauthorized action.');
        }
        else{

            //ambil data subAct dari Act yang aktif
            $sub = SubAct::DataSub($act -> id);

            //redirect ke view edit act dengan $datausaha
            return view('acts.edit', compact('datausaha', 'act', 'sub'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Act $act)
    {
        $act -> update($this->validatedData());
        return redirect()->route('acts.index')->with('success', 'Perubahan berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Act $act)
    {
        $act -> delete();

        return redirect()->route('acts.index')->with('success', 'Data Aktivitas Berhasil Dihapus!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'usaha_id' => 'required',
            'nama' => 'required',
        ]);
    }
}
