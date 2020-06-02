<?php

namespace App\Http\Controllers;

use App\CheckRequest\RequestSession;
use App\CheckRequest\UsahaSession;
use App\Resource;
use App\Usaha;
use Illuminate\Pipeline\Pipeline;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Resource $resource)
    {
        $akses = $this->cekAkses();

        if ($akses == true){

            //ambil semua resource yang sesuai dengan id_usaha di session u
            $resource = Resource::DaftarResources();
            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

            //redirect ke view tabel produk dengan $datausaha
            return view('resources.index', compact('datausaha', 'resource'));
        }

        else if ($akses == false){

            return redirect()->route('home')->with('notif', 'Sesi telah berakhir! Silahkan akses menu dari Dashboard Badan Usaha Anda');

        }

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
    public function store(Resource $resource)
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
}
