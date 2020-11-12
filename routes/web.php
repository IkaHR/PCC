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
use App\SubAct;
use App\Resource;

Route::get('/m2m', function () {

    $act = Act::with(['sub_acts', 'resources'])
        ->addSelect([
            'menit' => SubAct::selectRaw('TRIM(SUM(frekuensi * idx * 0.36) / 60)+0 as "menit"')
                ->whereColumn('act_id', 'acts.id'),
            'totalTMU' => SubAct::selectRaw('SUM(frekuensi * idx * 10) as "totalTMU"')
                ->whereColumn('act_id', 'acts.id'),
        ])
        ->where('id', 2)
        ->first();

    foreach($act->sub_acts as $sub){

        $fq = $sub->frekuensi;
        $idx = $sub->idx;

        $menit = $fq * $idx * 0.36 / 60;

        $detik = $fq * $idx * 0.36;

        $data = array(
            'menit' => $menit,
            'detik' => $detik,
        );

        \Illuminate\Support\Facades\Session::push('sub-act', $data);

    }

    // simpan array sesi dalam variabel
    $arr = session('sub-act');

    // jumlahkan bagian menit saja
    $totalMenit = array_sum(array_column($arr, 'menit'));

    dd($totalMenit);

//    session()->forget('sub-act');

    // ===================================================================


//    dd(array_sum($arr));

//    dd(session('sub-act'));

//    $actPracticalCapacity = $act->menit;
//
//    foreach ($act->resources as $r){
//
//        $umur = $r->umur;
//        $biaya = $r->biaya;
//        $perawatan = $r->perawatan;
//
//        $actResQT = $r->pivot->kuantitas;
//
//        // penghitungan biaya resource per tahun
//        // misal 200,000 / thn
//        $resCostRate = ( ( $biaya / $umur ) + $perawatan );
//
//        // ubah biaya dari per tahun menjadi per menit
//        // misal: 200,000 / tahun = 0.38 / menit
//        $resCostRateMin = $resCostRate / 525600;
//
//        // penghitungan cost Act
//        // biaya res / menit * kuantitas res yang digunakan
//        $act_Cost = $resCostRateMin * $actResQT * $actPracticalCapacity;
//
//        $act_CostRate = $act_Cost / $actPracticalCapacity;
//
//        $data = array(
//            "act_id" => $act->id,
//            "resource_id" => $r->pivot->resource_id,
//            "resource_tersedia" => $r->kuantitas,
//            "resource_costRate_tahun" => $resCostRate,
//            "resource_costRate_menit" => $resCostRateMin,
//            "kuantitas_terpakai" => $r->pivot->kuantitas,
//            "act_cost" => $act_Cost,
//            "act_cost-rate" => $act_CostRate,
//        );
//
//        \Illuminate\Support\Facades\Session::push('data-act', $data);
//
////        echo " || ".$r->id." | ".$resCostAct." || ";
//
//    }
//
//    \Illuminate\Support\Facades\Session::forget('data-act');
//
//    dd(session('data-act'));

});


Route::get('/tes', function () {

    $param = 'dari tes ke tambah';
    return redirect()->to('/tambah?a='.$param);
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
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::put('/profiles/changepass', 'ProfileController@changepass')->name('profiles.changepass');
    Route::resource('profiles', 'ProfileController');
    Route::resource('usahas', 'UsahaController');
    Route::resource('produks', 'ProdukController');
    Route::resource('resources', 'ResourceController');
    Route::resource('acts', 'ActController');
    Route::resource('subs', 'SubActController');
    Route::resource('direct-exps', 'DirectExpController');
    Route::resource('act-res', 'ActResourceController');
});

