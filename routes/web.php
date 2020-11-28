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

Route::get('/tespro', function () {

    event(new \App\Events\PelaporanBiayaProdukEvent(3));

});

Route::get('/pro', function () {

    $produk = Produk::DaftarProduk()->where('id', 3)->first();

    foreach ($produk->acts as $a){

        $actPro = Act::DataActs()->where('id', $a->id)->first();

        $act_totalTIme = $actPro->menit * $a->pivot->frekuensi;

        $act_costrate = $a->act_costrate->biaya;

        $cost = $act_totalTIme * $a->act_costrate->biaya;

        $data = array(
//            "act_id" => $a->id,
//            "act_totaltime" => $act_totalTIme,
//            "act_costrate" => $act_costrate,
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


Route::get('/tessesi', function () {

//    session()->forget('final_cost');

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

