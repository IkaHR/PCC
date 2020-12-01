<html>
<head>
    <title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<style type="text/css">
    table tr td,
    table tr th{
        font-size: 9pt;
    }
</style>
<center>
    <h5>{{ $produk->jenis==1 ? 'Produk' : 'Layanan' }} {{ $produk->nama }}</h5>
    <h6>{{ strtoupper($datausaha->nama) }}</h6>
    <span>BY: {{ strtoupper(Auth::user()->name) }} | {{ date('d-m-Y') }}</span>
</center>
<br />
<h6>
    <span style="color: #2b982b;">Total Waktu Proses {{ $produk->jenis==1 ? 'Produksi' : 'Layanan' }}: 
    </span>{{ session('final_time') }} menit</h6>
<h6>
    <span style="color: #2b982b;">Total Biaya {{ $produk->jenis==1 ? 'Produksi' : 'Layanan' }}: </span>
    @currency(session('final_cost'))
</h6>
<hr />
<!-- TABEL DAFTAR AKTIVITAS -->
<h5>Daftar Aktivitas dalam {{ $produk->jenis==1 ? 'Produksi' : 'Layanan' }}</h5>
<table width="100%">
    <thead>
    <tr>
        <th>Aktivitas</th>
        <th>Cost Rate<br><small>(per menit)</small></th>
        <th>Waktu<br>(menit)</th>
        <th>Frekuensi<br>Pengulangan</th>
        <th>Total Waktu<br>(menit)</th>
        <th>Total Biaya</th>
    </tr>
    </thead>
    <tbody>
    @foreach($produk->acts as $a)
        @php($act = \App\Act::ActsDiBlade($a->id))
        <tr>
            <td>{{ $a->nama }}</td>
            <td>@currency($act->act_costrate->biaya)</td>
            <td>{{ $act->menit }}</td>
            <td>{{ $a->pivot->frekuensi }} kali</td>
            <td>{{ $a->pivot->frekuensi * $act->menit}}</td>
            <td>@currency($act->act_costrate->biaya * $a->pivot->frekuensi * $act->menit)</td>
        </tr>
    @endforeach
    </tbody>
</table>
<br />
<!-- #END# TABEL DAFTAR AKTIVITAS -->

<!-- TABEL DAFTAR BIAYA LANGSUNG -->
@unless($produk->directs->isEmpty())
    <h5>Daftar Biaya Langsung dalam {{ $produk->jenis==1 ? 'Produksi' : 'Layanan' }}</h5>
    <table width="100%">
        <thead>
        <tr>
            <th>Biaya Langsung</th>
            <th>Biaya Satuan</th>
            <th>Kuantitas<br>digunakan</th>
            <th>Total Biaya</th>
        </tr>
        </thead>
        <tbody>
        @foreach($produk->directs as $d)
            <tr>
                <td>{{ $d->nama }}</td>
                <td>@currency($d->biaya)</td>
                <td>{{ $d->pivot->kuantitas }}</td>
                <td>@currency($d->biaya * $d->pivot->kuantitas)</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endunless
<!-- #END# TABEL DAFTAR BIAYA LANGSUNG -->

<hr />

<!-- DETAIL AKTIVITAS -->
<h5>Detail Aktivitas dalam {{ $produk->jenis==1 ? 'Produksi' : 'Layanan' }}</h5>
@foreach($act_produk as $ap)
    <h6><span style="color: #2b982b;">{{ $ap->nama }}</span></h6>

    <!-- TABEL SUB AKTIVITAS -->
    <table width="100%">
        <thead>
        <tr>
            <th>Sub Aktivitas</th>
            <th>Index</th>
            <th>TMU</th>
            <th>Total Waktu<br>(detik)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ap->sub_acts as $s)
            <tr>
                <td>{{ $s->detail }}</td>
                <td>{{ $s->idx }}</td>
                <td>{{ $s->idx * 10 }}</td>
                <td>{{ $s->idx * 10 * 0.036 }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <!-- #END# TABEL SUB AKTIVITAS -->

    <br />

    <!-- TABEL RESOURCE / OVERHEAD -->
    <table width="100%">
        <thead>
        <tr>
            <th>Resource / Overhead</th>
            <th>Kuantitas<br>Tersedia</th>
            <th>Kuantitas<br>Digunakan</th>
            <th>Cost Driver Rate Unit<br>(per menit)</th>
            <th>Total Biaya<br>(per menit)</th>
        </tr>
        </thead>
        <tbody>
        @foreach($ap->resources as $r)
            <tr>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->kuantitas }}</td>
                <td>{{ $r->pivot->kuantitas }}</td>
                <td>@currency(((($r->biaya / $r->umur) + $r->perawatan) * $r->kuantitas) / 525600)</td>
                <td>@currency((((($r->biaya / $r->umur) + $r->perawatan) * $r->kuantitas) / 525600) * $r->pivot->kuantitas )</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br />
    <center>
        <span>-------------------------------------------------------------------</span>
    </center>
    <br />
    <!-- #END# TABEL RESOURCE / OVERHEAD -->

@endforeach

<!-- #END# DETAIL AKTIVITAS -->

</body>
</html>
