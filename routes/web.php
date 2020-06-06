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

Route::get('/tes2', function () {
    return redirect()->to('/tujuan#id');
});

Route::get('/tujuan', function () {
    $b = 'nyampek di tujuan #';
    dd($b);
});

Route::get('/sesi', function () {
    $cek = "asli";
//    return redirect()->to('/ceksesi'.session(['cek' => $cek]));
//    return route('ceksesi')->with('cek', $cek);
    return redirect('ceksesi'.$cek);
});

Route::get('/ceksesi', function () {
//    Session::forget('cek');
//    session()->forget('cek');

    session(['cek'=> 'diganti' ]);
    dd(session('cek'));
})->name('ceksesi');

Route::get('/cekcek', function () {
    dd(session('cek'));
});





Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function (){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('usaha', 'UsahaController');
    Route::resource('produk', 'ProdukController');
    Route::resource('resource', 'ResourceController');
    Route::resource('act', 'ActController');
    Route::resource('sub', 'SubActController');

});

