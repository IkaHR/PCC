<?php

namespace App\Http\Controllers;

use App\CheckRequest\AksesUsaha;
use App\CheckRequest\CekUsaha;
use App\Usaha;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class DashboardController extends Controller
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

            $datausaha = Usaha::usahaAktif(); //ambil data dari model Usaha yang aktif

            //redirect ke view tabel produk dengan $datausaha
            return view('dashboard', compact('datausaha'));
        }

        else if ($akses == false){

            return $this->backHome();
        }

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
        // hapus sesi 'a' yang merupakan id act yang masih aktif
        return session()->forget('a');
    }

    protected function backHome()
    {
        return redirect()->route('home')->with('notif', 'Sesi telah berakhir! Silahkan akses kembali menu Dashboard Badan Usaha Anda');
    }
}
