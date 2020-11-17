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
use App\Usaha;
use Illuminate\Support\Facades\Auth;

Route::get('/m2m', function () {

    $act = Act::DataActs();

    // simulasi pengulangan aktivitas dalam produksi
    $fq_act = 3;

    foreach($act as $a){

        $actPracticalCapacity = $a->menit;

        foreach ($a->resources as $r){

            $res = Resource::SemuaResource()->where('id', $r->id)->first();

            // kuantitas yang dipakai di act
            $actResQT = $r->pivot->kuantitas;

            // resource cost rate dari DB model Resource
            $resCostRate = $res->pertahun;
            $resCostRateMin = $res->permenit;

            // penghitungan cost Act
            // biaya res / menit * kuantitas res yang digunakan
            $act_Cost = $resCostRateMin * $actResQT * $actPracticalCapacity;

            $data = array(
                "act_id" => $a->id,
                "act_time" => $actPracticalCapacity,
                "resource_id" => $r->pivot->resource_id,
                "resource_tersedia" => $r->kuantitas,
                "resource_costRate_tahun_dariModel" => $resCostRate,
                "resource_costRate_menit_dariModel" => $resCostRateMin,
                "kuantitas_terpakai" => $r->pivot->kuantitas,
                "act_cost" => $act_Cost,
            );

            session()->push('data-act', $data);
        }

        // simpan array sesi dalam variabel
        $arr = session('data-act');

        // jumlahkan bagian menit saja
        $total = array_sum(array_column($arr, 'act_cost'));

        $cdr = $total / $actPracticalCapacity;

        $actProduct_cost = $cdr * $fq_act;

        $act_cdr = array(
            "act_id" => $a->id,
            "cdr" => $cdr,
            "actProduct_cost" => $actProduct_cost,
        );

        session()->push('act-cdr', $act_cdr);
    }

    // simpan array sesi dalam variabel
    $arr = session('act-cdr');

    /*
     * jumlahkan bagian actProduct_cost
     * untuk mendapatkan harga produk
    */
    $total = array_sum(array_column($arr, 'actProduct_cost'));

    // simulasi total biaya langsung yang berhubungan dengan produksi
    $biayaLangsung = 1000;

    $hargaProduk = $total + $biayaLangsung;

    dd($hargaProduk);

//    dd(session('act-cdr'));

//    session()->forget(['data-act', 'act-cdr']);

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
    Route::resource('act-pro', 'ActProdukController');
    Route::resource('direct-pro', 'DirectExpProdukController');
});

