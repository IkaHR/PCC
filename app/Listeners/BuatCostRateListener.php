<?php

namespace App\Listeners;

use App\ActCostRate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class BuatCostRateListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $data = array(
            "act_id" => $event->act->id,
            "biaya" => 0,
        );

        ActCostRate::create($data);
    }
}
