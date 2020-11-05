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

    $act = Act::addSelect([
        'menit' => SubAct::selectRaw('TRIM(SUM(frekuensi * idx * 0.36) / 60)+0 as "menit"')
            ->whereColumn('act_id', 'acts.id'),
        'totalTMU' => SubAct::selectRaw('SUM(frekuensi * idx * 10) as "totalTMU"')
            ->whereColumn('act_id', 'acts.id'),
        'res' => Resource::selectRaw('SUM((biaya/umur)+(perawatan*umur))*kuantitas) as "res"')
            ->wherePivot('act_id', 'acts.id'),
    ])
        ->where('id', 3)
        ->get();

    $act2 = Act::where('usaha_id', 1)->get();

//    $act->resources()->syncWithoutDetaching([
//        3 => [
//            'kuantitas' => '1'
//        ]
//    ]);

//    $act->resources()->detach('1');

//    $all = $act->resources()->get();

    dd($act);
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

