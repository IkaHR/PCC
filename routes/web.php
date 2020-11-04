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

Route::get('/', function () {
    return redirect()->route('home');
});

Route::get('/m2m', function () {

    $act = \App\Act::where('id', '3')->first();

//    $act->resources()->syncWithoutDetaching([
//        3 => [
//            'kuantitas' => '1'
//        ]
//    ]);

//    $act->resources()->detach('1');

    $all = $act->resources()->get();

    dd($all);
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

