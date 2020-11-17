<?php

namespace App\Http\Controllers;

use App\CheckRequest\AksesUsaha;
use App\CheckRequest\CekUsaha;
use App\Resource;
use App\Usaha;
use Illuminate\Pipeline\Pipeline;
use MongoDB\Driver\Session;

class ResourceController extends Controller
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

            $this->hapusSesiLama();

            //ambil semua resource yang sesuai dengan id_usaha di session u
            $resource_panjang = Resource::DaftarResourcesPanjang();
            $resource_pendek = Resource::DaftarResourcesPendek();
            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

            //redirect ke view tabel produk dengan $datausaha
            return view('resources.index', compact('datausaha', 'resource', 'resource_panjang', 'resource_pendek'));
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
            $resource = new resource();

            /*
             * r digunakan untuk menentukan jenis resource
             * 1 = resource jangka panjang
             * 2 = resource jangka pendek
            */

            if ( request('r') == 1 ){
                // form resource jangka panjang
                return view('resources.panjang.create', compact('resource', 'datausaha'));
            }

            elseif ( request('r') == 2 ){
                // form resource jangka pendek
                return view('resources.pendek.create', compact('resource', 'datausaha'));
            }

            return redirect()->route('resources.index')
                ->with('error', 'Sistem tidak dapat memproses! Silahkan coba lagi. ');
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
        $resource = Resource::create($this->validatedData());

        if(session()->has('a')){

            $jenis = $resource->jenis;
            $id = $resource->id;

            return redirect('/act-res/create?r='.$jenis.'&rid='.$id);
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
        $akses = $this->cekAkses();

        if ($akses == true){

            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
            $usaha_id = $datausaha -> id; //ambil id dari usaha aktif
            $usaha_key = $resource -> usaha_id; //ambil foreign key usaha_id dari tabel resource

            //cek apakah user yang aktif memiliki akses ke data usaha ini
            if ($usaha_key !== $usaha_id){
                return abort(403, 'Unauthorized action.');
            }
            else{

                if ( request('r') == 1 ){
                    // form resource jangka panjang
                    return view('resources.panjang.edit', compact('resource', 'datausaha'));
                }

                elseif ( request('r') == 2 ){
                    // form resource jangka pendek
                    return view('resources.pendek.edit', compact('resource', 'datausaha'));
                }

                return redirect()->route('resources.index')
                    ->with('error', 'Sistem tidak dapat memproses! Silahkan coba lagi. ');

                //redirect ke view edit resource dengan $datausaha
//                return view('resources.edit', compact('datausaha', 'resource'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Resource $resource)
    {
        $resource->update($this->validatedData());
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
        $resource->delete();
        return redirect()->route('resources.index')->with('success', 'Data Resource Berhasil Dihapus!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'usaha_id' => 'required',
            'nama' => 'required',
            'jenis' => 'required',
            'umur' => 'required',
            'biaya' => 'required',
            'perawatan' => 'required',
            'kuantitas' => 'required',
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

    protected function hapusSesiLama()
    {
        /*
         * hapus sesi 'a' & 'p'
         * 'a' = act_id
         * 'p' = produk_id
        */
        return session()->forget(['a', 'p']);
    }

    protected function backHome()
    {
        return redirect()->route('home')->with('notif', 'Sesi telah berakhir! Silahkan akses menu Data Resource dari Dashboard Badan Usaha Anda');
    }
}
