<?php

namespace App\Listeners;

use App\Act;
use App\ActCostRate;
use App\Resource;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateActCostRateListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $act = Act::DataActs()->where('id', $event->act_id)->first();
        $actTotalTime = $act->menit;

        if($act->resources->isEmpty() || $act->sub_acts->isEmpty()){

            $data = array(
                "act_id" => $event->act_id,
                "biaya" => 0,
            );

            $act->act_costrate()->update($data);
        }

        else{

            foreach ($act->resources as $r) {

                $resDalamAct = Resource::SemuaResource()->where('id', $r->id)->first();

                // kuantitas yang dipakai di act
                // ambil dari abel pivot act_resource
                $actResQT = $r->pivot->kuantitas;

                /*
                 * resource cost rate dari DB model Resource
                 * 1 tahun = 525600 menit
                 * Rumus 4 = ( biaya / umur ) + perawatan ) / 525600
                 */
                $resCostRateMin = $resDalamAct->permenit;

                /*
                 * penghitungan cost Act
                 * Rumus 5 = biaya res / menit * kuantitas res yang digunakan * lama aktivitas berlangsung
                 */
                $act_Cost = $resCostRateMin * $actResQT * $actTotalTime;

                $data = array(
                    "act_cost" => $act_Cost,
                );

                session()->push('cost', $data);
            }

            // simpan array sesi dalam variabel
            $arr_dataAct = session('cost');

            $totalActCost = array_sum(array_column($arr_dataAct, 'act_cost'));

            $actCostRate = $totalActCost / $actTotalTime;

            $data = array(
                "act_id" => $event->act_id,
                "biaya" => $actCostRate,
            );

            $act->act_costrate()->update($data);

            session()->forget('cost');

        }
    }
}
