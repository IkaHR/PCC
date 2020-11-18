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
use App\Produk;
use App\DirectExp;
use Illuminate\Support\Facades\Auth;

Route::get('/m2m', function () {

    $produk = Produk::DaftarProduk()->where('id', 2)->first();
    $act = Act::DataActs();
    $resource = Resource::SemuaResource();
    $direct = DirectExp::DaftarDirectExps();

    foreach($produk->acts as $a){

        $actDalamPro = $act->where('id', $a->id)->first();

        // ambil total menit dari DB model Act
        $actPracticalCapacity = $actDalamPro->menit;

        foreach ($a->resources as $r){

            $resDalamAct = $resource->where('id', $r->id)->first();

            // kuantitas yang dipakai di act
            // ambil dari abel pivot act_resource
            $actResQT = $r->pivot->kuantitas;

            // resource cost rate dari DB model Resource
            $resCostRate = $resDalamAct->pertahun;
            $resCostRateMin = $resDalamAct->permenit;

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
        $arr_actRes = session('data-act');

        // jumlahkan bagian menit saja
        $total = array_sum(array_column($arr_actRes, 'act_cost'));

        // penghitungan Cost Driver Rate per act
        $cdr = $total / $actPracticalCapacity;

        // ambil data frekuensi pengulangan Act
        // ambil dari tabel pivot act_produk
        $fq_act = $a->pivot->frekuensi;

        // penghitungan total cost per Act
        $actProduct_cost = $cdr * $fq_act;

        $act_cdr = array(
            "act_id" => $a->id,
            "cdr" => $cdr,
            "actProduct_fq" => $fq_act,
            "actProduct_cost" => $actProduct_cost,
        );

        session()->push('act-cdr', $act_cdr);
    }

    // simpan array sesi dalam variabel
    $arr_actPro = session('act-cdr');

    /*
     * jumlahkan bagian actProduct_cost
     * untuk mendapatkan harga produk
    */
    $totalActPro = array_sum(array_column($arr_actPro, 'actProduct_cost'));

    foreach ($produk->directs as $d){

        $directDalamPro = $direct->where('id', $d->id)->first();

        // ambil kuantitas yang digunakan
        // dari tabel pivot direct_produk
        $qtTerpakai = $d->pivot->kuantitas;

        // ambil data biaya direct_exp
        $biayaUnit = $directDalamPro->biaya;

        // hitung total biaya per elemen
        $total = $biayaUnit * $qtTerpakai;

        $direct_pro = array(
            "direct_id" => $d->id,
            "directProduct_qt" => $qtTerpakai,
            "directProduct_biayaUnit" => $biayaUnit,
            "directProduct_total" => $total,
        );

        session()->push('direct_pro', $direct_pro);
    }

    // simpan array sesi dalam variabel
    $arr_directPro = session('direct_pro');

    /*
     * jumlahkan bagian directProduct_total
     * untuk mendapatkan total biaya langsung dari produk
    */
    $totalDirectPro = array_sum(array_column($arr_directPro, 'directProduct_total'));

    $hargaProduk = $totalActPro + $totalDirectPro;

    dd($hargaProduk);

//    dd(session('direct_pro'));

//    session()->forget(['data-act', 'act-cdr', 'direct_pro']);

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

