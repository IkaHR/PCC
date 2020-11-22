@extends('layouts.header')

@section('title', 'Resources')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">

            @include('layouts.notification')

            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">RESOURCE / OVERHEAD</h4>
                        <small>Daftar sumber daya / overhead yang dimiliki oleh {{ $datausaha -> nama }}</small>
                    </div>
                    <div class="media-right">
                        <button class="btn btn-block btn-lg btn-success waves-effect"
                                onclick="window.location.href='{{ route('resources.create') }}';">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH RESOURCE/OVERHEAD</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kuantitas<br>Tersedia</th>
                                        <th>Umur<br>(thn)</th>
                                        <th>Biaya<br>(per unit)</th>
                                        <th>Perawatan Unit<br>(per tahun)</th>
                                        <th>Total Biaya<br>(per tahun)</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kuantitas<br>Tersedia</th>
                                        <th>Umur<br>(thn)</th>
                                        <th>Biaya<br>(per unit)</th>
                                        <th>Perawatan Unit<br>(per tahun)</th>
                                        <th>Total Biaya<br>(per tahun)</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($resource as $r)
                                        <tr>
                                            <td>{{ $r->nama }}</td>
                                            <td>{{ $r->kuantitas }}</td>
                                            <td>{{ $r->umur }}</td>
                                            <td>@currency($r->biaya)</td>
                                            <td>@currency($r->perawatan)</td>
                                            <td>@currency($r->pertahun)</td>
                                            <td>
                                                @if($r->deskripsi != null)
                                                    <button type="button" class="btn btn-default btn-block waves-effect" data-trigger="focus" data-container="body" data-toggle="popover"
                                                            data-placement="left" title="{{ $r->nama }}" data-content="{{ $r->deskripsi ?? '(Tidak ada catatan)' }}">
                                                        {{ \Illuminate\Support\Str::limit($r->deskripsi, 10, $end='...') }}
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <button onclick="window.location.href='{{ route('resources.edit', $r->id) }}?r=1';"
                                                        class="btn btn-warning waves-effect" type="button"
                                                        data-toggle="tooltip" data-placement="bottom" title="Pengaturan {{ $r->nama }}">
                                                    <i class="material-icons">settings</i>
                                                </button>&nbsp;
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
