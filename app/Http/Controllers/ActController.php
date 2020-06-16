<?php

namespace App\Http\Controllers;

use App\Act;
use App\CheckRequest\AksesUsaha;
use App\CheckRequest\CekUsaha;
use App\SubAct;
use App\Usaha;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\AbstractList;
use phpDocumentor\Reflection\Types\Self_;

class ActController extends Controller
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

            $dataAct = Act::with([
                        'sub_acts' => function ($query) {
                            $query->select( '*',
                                DB::raw('frekuensi * idx * 0.36 as "detik"'),
                                DB::raw('idx * 10 as "tmu"')
                            );
                        },
                    ])
                    ->get();

            dd($dataAct);

            //redirect ke view tabel produk dengan $datausaha
//            return view('acts.index', compact('datausaha', 'act'));
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
            $act = new act();
            return view('acts.create', compact('act', 'datausaha'));
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
        $act = Act::create($this->validatedData());

        return redirect()->to('/act/'.$act->id.'/edit')->with('notif', 'Silahkan tambahkan Sub-Aktivitas');
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
        $akses = $this->cekAkses();

        if ($akses == true){

            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif
            $usaha_id = $datausaha -> id; //ambil id dari usaha aktif
            $usaha_key = $act -> usaha_id; //ambil foreign key usaha_id dari tabel act

            //cek apakah user yang aktif memiliki akses ke data usaha ini
            if ($usaha_key !== $usaha_id){
                return abort(403, 'Unauthorized action.');
            }
            else{

                $id_act = $act -> id; //ambil id act yang aktif

                $datasub = SubAct::with('act')
                    ->select('*',
                        DB::raw('frekuensi * idx * 0.36 as "detik"'),
                        DB::raw('idx * 10 as "tmu"')
                    )
                    ->where('act_id', '=', $id_act)
                    ->get();

                //redirect ke view edit act dengan $datausaha
                return view('acts.edit', compact('datausaha', 'act', 'datasub'));
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
    public function update(Act $act)
    {
        $act -> update($this->validatedData());
        return redirect()->route('act.index')->with('notif', 'Perubahan berhasil disimpan!');
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
        return redirect()->route('act.index')->with('notif', 'Data Aktivitas Berhasil Dihapus!');
    }

    protected function validatedData()
    {
        return request()->validate([
            'usaha_id' => 'required',
            'nama' => 'required',
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
        return redirect()->route('home')->with('notif', 'Sesi telah berakhir! Silahkan akses menu Data Aktivitas dari Dashboard Badan Usaha Anda');
    }
}
