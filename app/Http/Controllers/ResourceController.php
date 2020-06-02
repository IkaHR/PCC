<?php

namespace App\Http\Controllers;

use App\CheckRequest\RequestSession;
use App\Resource;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\App;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Resource $resource)
    {
        $rrr = Resource::query();
        $rr = Resource::where('usaha_id', session('u'))->get();

        $r = app(Pipeline::class)
            ->send(request())
            -> through([
                \App\CheckRequest\RequestSession::class,
                \App\CheckRequest\UsahaSession::class,
            ])
            -> thenReturn();
        dd($r);


//        $resource = Resource::DaftarResources() //ambil semua resource yang sesuai dengan id_usaha di session u
//        $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
//        //redirect ke view tabel produk dengan $datausaha
//        return view('resources.index', compact('datausaha', 'resource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
