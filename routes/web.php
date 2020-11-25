<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Act;
use App\Resource;
use App\Produk;
use App\DirectExp;
use Illuminate\Support\Facades\Auth;

Route::get('/ap', function () {

    $produk = Produk::DaftarProduk()->where('id', 2)->first();

    foreach ($produk->acts as $a){

        $actPro = Act::DataActs()->where('id', $a->id)->first();

        $act_totalTIme = $actPro->menit * $a->pivot->frekuensi;

        $act_costrate = $a->act_costrate->biaya;

        $cost = $act_totalTIme * $a->act_costrate->biaya;

        $data = array(
            "act_id" => $a->id,
            "act_totaltime" => $act_totalTIme,
            "act_costrate" => $act_costrate,
            "cost" => $cost,
        );

        session()->push('ap', $data);
    }

    $arr_actPro = session('ap');
    $totalCost = array_sum(array_column($arr_actPro, 'cost'));

    dd($totalCost);

});

Route::get('/ar', function () {

    $act = Act::DataActs()->where('id', 8)->first();

    $actTotalTime = $act->menit;

    if($act->resources->isEmpty() || $act->sub_acts->isEmpty()){

        dd('data kurang lengkap');

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
//                "act_nama" => $act->nama,
//                "act_time" => $actTotalTime,
//                "resource_id" => $r->nama,
//                "resource_tersedia" => $r->kuantitas,
//                "kuantitas_terpakai" => $r->pivot->kuantitas,
//                "resource_costRate_menit_dariModel" => $resCostRateMin,
                "act_cost" => $act_Cost,
            );

            session()->push('act_cost', $data);
        }

//        session()->forget('act_cost');
//        dd(session('act_cost'));

        // simpan array sesi dalam variabel
        $arr_dataAct = session('act_cost')?? 0;

        $totalActCost = array_sum(array_column($arr_dataAct, 'act_cost'));

        $actCostRate = $totalActCost / $actTotalTime;

        dd($actCostRate);


    }


});


Route::get('/dp', function () {

    $produk = Produk::DaftarProduk()->where('id', 2)->first();

    foreach ($produk->directs as $d){

        $directDalamPro = DirectExp::DaftarDirectExps()->where('id', $d->id)->first();

        $direct_total = $directDalamPro->biaya * $d->pivot->kuantitas;

        $direct_pro = array(
            "direct_id" => $d->id,
            "direct_nama" => $d->nama,
            "directProduct_biayaUnit" => $directDalamPro->biaya,
            "qt" => $d->pivot->kuantitas,
            "directExp_total" => $direct_total,
        );

        session()->push('dp', $direct_pro);
    }

//    session()->forget('dp');

    // simpan array sesi dalam variabel
    $arr_directPro = session('dp');

    dd($arr_directPro);

});


Route::get('/pro', function () {

    $produk = Produk::DaftarProduk()->where('id', 2)->first();

    foreach ($produk->acts as $a){

        $actPro = Act::DataActs()->where('id', $a->id)->first();

        $act_totalTIme = $actPro->menit * $a->pivot->frekuensi;

        $act_costrate = $a->act_costrate->biaya;

        $cost = $act_totalTIme * $a->act_costrate->biaya;

        $data = array(
            "act_id" => $a->id,
            "act_totaltime" => $act_totalTIme,
            "act_costrate" => $act_costrate,
            "cost" => $cost,
        );

        session()->push('ap', $data);
    }

    $arr_actPro = session('ap');
    $totalCost = array_sum(array_column($arr_actPro, 'cost'));

//    dd($totalCost);

    if($produk->directs->isEmpty()){

        dd($totalCost);

    }
    else{

        foreach ($produk->directs as $d){

            $directDalamPro = DirectExp::DaftarDirectExps()->where('id', $d->id)->first();

            $direct_total = $directDalamPro->biaya * $d->pivot->kuantitas;

            $direct_pro = array(
//                "direct_id" => $d->id,
//                "direct_nama" => $d->nama,
//                "directProduct_biayaUnit" => $directDalamPro->biaya,
//                "qt" => $d->pivot->kuantitas,
                "directExp_total" => $direct_total,
            );

            session()->push('dp', $direct_pro);
        }

        // simpan array sesi dalam variabel
        $arr_directPro = session('dp');
        $totalDirectExp = array_sum(array_column($arr_directPro, 'directExp_total'));

        $finalCost = $totalCost + $totalDirectExp;

        dd($finalCost);

//    session()->forget(['dp', 'ap'])
    }

});


Route::get('/tes', function () {

    dd(session()->all());

});

Route::get('/tambah', function () {
    $b = 'isian tambahan B';
    $query = array_merge(
        request()->query(),
        ['b' => $b]
    );
    return redirect()->to('/sampek' . '?' . http_build_query($query));
});

Route::get('/sampek', function () {
    $b = request()->b;
    dd($b);
});

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function (){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::put('/profiles/changepass', 'ProfileController@changepass')->name('profiles.changepass');
    Route::resource('profiles', 'ProfileController');
    Route::resource('usahas', 'UsahaController');
    Route::get('/report', function () {
        return view('report');
    });

    Route::group(['middleware' => 'usaha'], function (){
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('produks', 'ProdukController');
        Route::resource('resources', 'ResourceController');
        Route::resource('acts', 'ActController');
        Route::resource('subs', 'SubActController');
        Route::resource('direct-exps', 'DirectExpController');
        Route::resource('act-res', 'ActResourceController');
        Route::resource('act-pro', 'ActProdukController');
        Route::resource('direct-pro', 'DirectExpProdukController');
    });
});

