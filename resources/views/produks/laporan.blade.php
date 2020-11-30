<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Biaya | PCC</title>
    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .report table {
            margin: 15px;
        }
        .report h3{
            margin-left: 15px;
        }
        .report h5{
            margin-left: 15px;
            color: #2b982b;
        }
        .report h6{
            margin-left: 15px;
        }
        .information {
            background-color: #8BC34A;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="information">
    <table width="100%">
        <tr>
            <td align="left" style="width: 40%;">
                <h3>{{ strtoupper($datausaha->nama) }}</h3>
                <pre>
                    Tanggal:  {{ date('d-m-Y') }}

                    Pukul: {{ date('H:i:s') }}
                </pre>
            </td>
            <td align="center">
                <img src="{{ asset('images/user-img-background.jpg') }}" alt="Logo" width="64" class="logo"/>
            </td>
            <td align="right" style="width: 40%;">
                <h3>{{ strtoupper(Auth::user()->name) }} | PCC</h3>
                <pre>
                    Production Cost Counter

                    &copy; {{ date('Y') }} - All rights reserved.
                </pre>
            </td>
        </tr>
    </table>
</div>

<br/>

<div class="report">
    <h3>{{ $produk->jenis==1 ? 'Produk' : 'Layanan' }} {{ $produk->nama }}</h3>

    <h6><span style="color: #2b982b;">Total Waktu Pengerjaan: </span>{{ session('final_time') }} menit</h6>
    <h6>
        <span style="color: #2b982b;">Total Biaya {{ $produk->jenis==1 ? 'Produksi' : 'Layanan' }}: </span>
        @currency(session('final_cost'))
    </h6>
    <hr />
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
    <hr>
</div>
</body>
</html>
