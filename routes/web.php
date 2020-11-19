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

Route::get('/ap', function () {

    $produk = Produk::DaftarProduk()->where('id', 2)->first();

    foreach ($produk->acts as $a){

        $actPro = Act::DataActs()->where('id', $a->id)->first();

        $data = array(
            "act_id" => $a->id,
            "act_nama" => $a->nama,
            "act_time" => $actPro->menit,
            "fq" => $a->pivot->frekuensi,
            "act_totaltime" => $actPro->menit * $a->pivot->frekuensi,
        );

        session()->push('ap', $data);
    }

//    session()->forget('ap');

    $arr_actPro = session('ap');

    dd($arr_actPro);

});

Route::get('/ar', function () {

    $act = Act::DataActs()->where('id', 4)->first();

    foreach ($act->resources as $r){

        $actTotalTime = $act->menit;

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
            "act_nama" => $act->nama,
            "act_time" => $actTotalTime,
            "resource_id" => $r->nama,
            "resource_tersedia" => $r->kuantitas,
            "kuantitas_terpakai" => $r->pivot->kuantitas,
            "resource_costRate_menit_dariModel" => $resCostRateMin,
            "act_cost" => $act_Cost,
        );

        session()->push('ar', $data);
    }

//    session()->forget('data-act');

    // simpan array sesi dalam variabel
    $arr_dataAct = session('ar');

    dd($arr_dataAct);

});


Route::get('/dp', function () {

    $produk = Produk::DaftarProduk()->where('id', 2)->first();

        foreach ($produk->directs as $d){

        $directDalamPro = DirectExp::DaftarDirectExps()->where('id', $d->id)->first();

        $direct_pro = array(
            "direct_id" => $d->id,
            "direct_nama" => $d->nama,
            "directProduct_biayaUnit" => $directDalamPro->biaya,
            "qt" => $d->pivot->kuantitas,
            "directExp_total" => $directDalamPro->biaya * $d->pivot->kuantitas,
        );

        session()->push('dp', $direct_pro);
    }

    // simpan array sesi dalam variabel
    $arr_directPro = session('dp');

    dd($arr_directPro);

});


Route::get('/pro', function () {

    $produk = Produk::DaftarProduk()->where('id', 2)->first();

    dd($produk);

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

