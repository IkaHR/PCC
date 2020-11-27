<?php

namespace App\Providers;

use App\Events\ActBaruDitambahkanEvent;
use App\Events\DataRelasiActBerubahEvent;
use App\Events\MulaiPelaporanBiayaProdukEvent;
use App\Listeners\BuatCostRateListener;
use App\Listeners\HitungBiayaProduksiListener;
use App\Listeners\UpdateActCostRateListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ActBaruDitambahkanEvent::class => [
            BuatCostRateListener::class,
        ],
        DataRelasiActBerubahEvent::class => [
            UpdateActCostRateListener::class,
        ],
        MulaiPelaporanBiayaProdukEvent::class => [
            HitungBiayaProduksiListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
