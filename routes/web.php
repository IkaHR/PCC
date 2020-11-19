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

        /*
         * ambil total menit dari DB model Act
         *
         * Rumus 1 = penghitungan di sub-Aktivitas
         * Rumus 2 = SUM(frekuensi * idx * 0.36) / 60
        */
        $actTotalTime = $actDalamPro->menit;

        /*
         * penghitungan Practical Capacity dari Akivitas
         *
         * Rumus 3 = Total waktu act * banyaknya produk yang diproduksi
         * dalam aplikasi, penghitungan dilakukan untuk 1 produk per produksi
        */
        $actPracticalCap = $actTotalTime * 1;

        foreach ($a->resources as $r){

            $resDalamAct = $resource->where('id', $r->id)->first();

            // kuantitas yang dipakai di act
            // ambil dari abel pivot act_resource
            $actResQT = $r->pivot->kuantitas;

            /*
             * resource cost rate dari DB model Resource
             * 1 tahun = 525600 menit
             * Rumus 4 = ( biaya / umur ) + perawatan ) / 525600
             */
            $resCostRate = $resDalamAct->pertahun;
            $resCostRateMin = $resDalamAct->permenit;

            /*
             * penghitungan cost Act
             * 1 tahun = 525600 menit
             * Rumus 5 = biaya res / menit * kuantitas res yang digunakan * lama penggunaan
             */
            $act_Cost = $resCostRateMin * $actResQT * $actTotalTime;

            $data = array(
                "act_id" => $a->id,
                "act_time" => $actTotalTime,
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
        $arr_dataAct = session('data-act');

        // CA = jumlah semua act_cost dalam array
        // hasil akhir dari rumus 5
        $totalCostAct = array_sum(array_column($arr_dataAct, 'act_cost'));

        /*
         * penghitungan Cost Driver Rate per act
         * Rumus 6 = total cost aktivitas / practical activity
         * hasilnya didapatkan biaya aktivitas per menit
         */
        $CRA = $totalCostAct / $actPracticalCap;

        /*
         * ambil data frekuensi pengulangan Act
         * ambil dari tabel pivot act_produk
         */
        $fq_act = $a->pivot->frekuensi;

        // penghitungan activity consumed by product
        // hasilnya didapatkan total waktu pengerjaan aktivitas dalam proses produksi
        $ACp = $actTotalTime * $fq_act;

        /*
         * penghitungan total Cost Product per Act
         * Rumus 7 = $CRA * $ACp
         *
         * misal:
         * dalam produksi suatu unit barang, aktivitas X dilakukan sebanyak 3 kali.
         * sementara waktu yang diperlukan untuk melakukan aktivitas X adalah 2 menit.
         *
         * Maka ACp = 2 menit x 3 = 6 menit
         *
         * Lalu, Cost Rate dari aktivitas X adalah 5,000/menit
         * maka total biaya aktivitas dalam produk adalah:
         * 5,000/menit x 6 menit = 30,000
         */
        $Cp = $CRA * $ACp;

        $act_cdr = array(
            "act_id" => $a->id,
            "act_costRate" => $CRA,
            "actProduct_fq" => $fq_act,
            "Cp" => $Cp,
        );

        session()->push('act-cdr', $act_cdr);
    }

    // simpan array sesi dalam variabel
    $arr_actPro = session('act-cdr');

    /*
     * jumlahkan bagian actProduct_cost
     * untuk mendapatkan harga produk
     * hasil akhir dari rumus 7
    */
    $totalCp = array_sum(array_column($arr_actPro, 'Cp'));

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
            "directExp_total" => $total,
        );

        session()->push('direct_pro', $direct_pro);
    }

    // simpan array sesi dalam variabel
    $arr_directPro = session('direct_pro');

    /*
     * jumlahkan bagian directProduct_total
     * untuk mendapatkan total biaya langsung dari produk
    */
    $totalDirectEx = array_sum(array_column($arr_directPro, 'directExp_total'));

    $hargaProduk = $totalCp + $totalDirectEx;

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

