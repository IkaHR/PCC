<?php

namespace App\Listeners;

use App\Act;
use App\DirectExp;
use App\Produk;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HitungBiayaProduksiListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $produk = Produk::DaftarProduk()->where('id', $event->produk_id)->first();

        foreach ($produk->acts as $a){

            $actPro = Act::DataActs()->where('id', $a->id)->first();

            /*
             * Penghitungan total waktu aktivitas dalam produksi
             * yaitu dengan:
             * lama waktu pengerjaan aktivitas * frekuensi pengulangan aktivitas dalam produksi
             */
            $act_totalTIme = $actPro->menit * $a->pivot->frekuensi;

            /*
             * Data Costrate Aktivitas
             * diproses dalam listener UpdateActCostRateListener
             * yang dijalankan oleh event DataRelasiActBerubahEvent
             */
            $act_costrate = $a->act_costrate->biaya;

            /*
             * Rumus 7
             * Total biaya aktivitas dalam produksi =
             * Total waktu Aktivitas dalam produksi * Costrate Aktivitas tsb
             */
            $cost = $act_totalTIme * $act_costrate;

            $data = array(
                "cost" => $cost,
            );

            session()->push('act_cost', $data);
        }

        $arr_actPro = session('act_cost');

        // jumlah semua cost dari masing-masing biaya Aktivitas dalam produksi
        $totalCost = array_sum(array_column($arr_actPro, 'cost'));

        if($produk->directs->isEmpty()){

            /*
             * Jika produk tidak memiliki Biaya Langsung
             * maka total akhirnya = jumlah seluruh act_cost
             */
            dd($totalCost);

        }
        else{

            foreach ($produk->directs as $d){

                $directDalamPro = DirectExp::DaftarDirectExps()->where('id', $d->id)->first();

                $direct_total = $directDalamPro->biaya * $d->pivot->kuantitas;

                $direct_pro = array(
                    "directExp_total" => $direct_total,
                );

                session()->push('direct_cost', $direct_pro);
            }

            // simpan array sesi dalam variabel
            $arr_directPro = session('direct_cost');
            $totalDirectExp = array_sum(array_column($arr_directPro, 'directExp_total'));

            /*
             * Rumus 8
             * Biaya produk akhir = total biaya aktivitas + biaya langsung
             */
            $finalCost = $totalCost + $totalDirectExp;

            session()->forget(['direct_cost', 'act_cost']);

            dd($finalCost);
        }
    }
}
