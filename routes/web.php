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

Route::get('/tessesi', function () {
//    session()->forget('final_cost');
    dd(session()->all());
});

Route::get('/time', function () {
    dd(time());
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
    Route::get('/download/{file}', 'DownloadController@download');

    Route::group(['middleware' => 'usaha'], function (){
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('produks', 'ProdukController');
        Route::get('/produks/laporan/{produk}', 'ProdukController@laporan')->name('produks.laporan');
        Route::resource('resources', 'ResourceController');
        Route::resource('acts', 'ActController');
        Route::resource('subs', 'SubActController');
        Route::resource('direct-exps', 'DirectExpController');
        Route::resource('act-res', 'ActResourceController');
        Route::resource('act-pro', 'ActProdukController');
        Route::resource('direct-pro', 'DirectExpProdukController');
    });
});

