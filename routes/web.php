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

//    $act = \App\Act::where('id', '3')->first();

    $act = Act::with(['sub_acts', 'resources'])
        ->addSelect([
            'menit' => SubAct::selectRaw('TRIM(SUM(frekuensi * idx * 0.36) / 60)+0 as "menit"')
                ->whereColumn('act_id', 'acts.id'),
            'totalTMU' => SubAct::selectRaw('SUM(frekuensi * idx * 10) as "totalTMU"')
                ->whereColumn('act_id', 'acts.id'),
        ])
        ->where('id', 3)
        ->first();

    $resource = Resource::with('acts')
                ->where('id', 1)
                ->first();

    dd($resource);

//    foreach ($resource->acts as $a){
//
//        $act_id = $a->pivot->act_id;
//        $res_id = $a->pivot->resource_id;
//        $kuantitas = $a->pivot->kuantitas;
//
//        echo " | act = ".$act_id." | res = ".$res_id." | kuantitas = ".$kuantitas." | ";
//
//    }

    /*
     * RUMUS :
     * (biaya/umur)+(perawatan*umur))*kuantitas = cd resource
     * 1 tahun = 525600 menit
     * ((cd resource * pivot_kuantitas) / 525600) * acts.menit = cd act
    */

//    $totalWaktuAct = $act->menit;

//    foreach ($act->resources as $r){
//
//        $kuantitas = $r->kuantitas;
//        $umur = $r->umur;
//        $biaya = $r->biaya;
//        $perawatan = $r->perawatan;
//
//        $actResQT = $r->pivot->kuantitas;
//
//        $resCostRate = ( ( $biaya / $umur ) + $perawatan ) * $kuantitas;
//
//        $resCostAct = ( $resCostRate * $actResQT ) / 525600;
//
//        $data = array(
//            "act_id" => $act->id,
//            "resource_id" => $r->pivot->resource_id,
//            "kuantitas" => $r->pivot->kuantitas,
//            "biaya" => $resCostAct,
//        );
//
//        \Illuminate\Support\Facades\Session::push('data-act', $data);
//
////        echo " || ".$r->id." | ".$resCostAct." || ";
//
//    }

//    \Illuminate\Support\Facades\Session::forget('data-act');

//    dd(session('data-act'));

//    dd($act->resources);

//    $act->resources()->syncWithoutDetaching([
//        3 => [
//            'kuantitas' => '1'
//        ]
//    ]);

//    $act->resources()->detach('1');

//    $all = $act->resources()->get();

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

