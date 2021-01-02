<?php

namespace App\Http\Controllers;

use App\Events\DataRelasiActBerubahEvent;
use App\Resource;
use App\Usaha;

class ResourceController extends Controller
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
        //ambil semua resource yang sesuai dengan id_usaha di session u
        $resource = Resource::SemuaResource();
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

        //redirect ke view tabel produk dengan $datausaha
        return view('resources.index', compact('datausaha', 'resource'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
        $resource = new resource();

        return view('resources.create', compact('resource', 'datausaha'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $resource = Resource::create($this->validatedData());

        if(session()->has('a')){

            $jenis = $resource->jenis;
            $id = $resource->id;

            return redirect('/act-res/create?rid='.$id);
        }

        return redirect()->route('resources.index')->with('success', 'Data Resource berhasil disimpan!');
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
    public function edit(Resource $resource)
    {
        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
        $usaha_id = session('u'); //ambil id dari usaha aktif di sesi 'u'
        $usaha_key = $resource -> usaha_id; //ambil foreign key usaha_id dari tabel resource

        //cek apakah user yang aktif memiliki akses ke data usaha ini
        if ($usaha_key != $usaha_id){
            return abort(403, 'Unauthorized action.');
        }
        else{

            return view('resources.edit', compact('resource', 'datausaha'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Resource $resource)
    {
        $resource->update($this->validatedData());

        foreach($resource->acts as $a){
            event(new DataRelasiActBerubahEvent($a->id));
        }

        return redirect()->route('resources.index')->with('success', 'Perubahan berhasil disimpan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        $relasi_act = $resource->acts;

        $resource->delete();

        foreach($relasi_act as $a){
            event(new DataRelasiActBerubahEvent($a->id));
        }

        return redirect()->route('resources.index')->with('success', 'Data Resource Berhasil Dihapus!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'usaha_id' => 'required',
            'nama' => 'required',
            'umur' => 'required',
            'biaya' => 'required',
            'perawatan' => 'required',
            'kuantitas' => 'required',
            'deskripsi' => 'nullable',
        ]);
    }
}
