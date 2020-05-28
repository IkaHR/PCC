@extends('layouts.header')

@section('title', 'Produk/Layanan')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">PRODUK & LAYANAN </h4>
                        <small>Daftar Produk dan Layanan dari {{ Auth::user()->name }}</small>
                    </div>
                    <div class="media-right">
                        <button onclick="window.location.href='{{ route('produk.create') }}';" class="btn btn-block btn-lg btn-success waves-effect">
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
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Keterangan</th>
                                            <th>Produksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>tes</td>
                                            <td>tes</td>
                                            <td>tes</td>
                                            <td>
                                            <button onclick="window.location.href='#';" class="btn bg-cyan waves-effect">
                                                <i class="material-icons">data_usage</i>
                                                <span>Aktivitas</span>
                                            </button>&nbsp;
                                            <button onclick="window.location.href='#';" class="btn btn-warning waves-effect">
                                                <i class="material-icons">monetization_on</i>
                                                <span>Biaya</span>
                                            </button>
                                            </td>
                                        </tr>
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
