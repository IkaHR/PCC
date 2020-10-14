@extends('layouts.header')

@section('title', 'Produk/Layanan')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">

            @if (session()-> has('notif'))
                <div class="alert bg-teal alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session()->get('notif') }}
                </div>
            @endif

            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">PRODUK & LAYANAN </h4>
                        <small>Daftar Produk dan Layanan yang dimiliki oleh {{ $datausaha -> nama }}</small>
                    </div>
                    <div class="media-right">
                        <button onclick="window.location.href='{{ route('produks.create') }}';" class="btn btn-block btn-lg btn-success waves-effect">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH PRODUK/LAYANAN</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
            <!-- TABEL DAFTAR PRODUK/LAYANAN -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Keterangan</th>
                                            <th>Produksi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Keterangan</th>
                                            <th>Produksi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($produk as $p)
                                        <tr>
                                            <td>{{ $p->nama }}</td>
                                            <td> @if($p->jenis==1) Produk @else Layanan @endif </td>
                                            <td>{{ $p->deskripsi }}</td>
                                            <td>
                                            <button onclick="window.location.href='#';" class="btn bg-cyan waves-effect">
                                                <i class="material-icons">data_usage</i>
                                                <span>Aktivitas</span>
                                            </button>&nbsp;
                                            <button onclick="window.location.href='#';" class="btn bg-green waves-effect">
                                                <i class="material-icons">monetization_on</i>
                                                <span>Biaya</span>
                                            </button>&nbsp;
                                            </td>
                                            <td>
                                                <button onclick="window.location.href='{{ route('produks.edit', $p->id) }}';"
                                                        class="btn btn-warning waves-effect" type="button"
                                                        data-toggle="tooltip" data-placement="bottom" title="Pengaturan {{ $p->nama }}">
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
            <!-- #END# TABEL DAFTAR PRODUK/LAYANAN -->
        </div>
    </section>
@endsection
