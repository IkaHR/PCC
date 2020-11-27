@extends('layouts.header')

@section('title', 'Pengeluaran Langsung')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">

            @include('layouts.notification')

            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">DAFTAR PENGELUARAN LANGSUNG</h4>
                        <small>Daftar pengeluaran yang berhubungan langsung dengan produk milik {{ $datausaha -> nama }}</small>
                    </div>
                    <div class="media-right">
                        <button onclick="window.location.href='{{ route('direct-exps.create') }}';" class="btn btn-block btn-lg btn-success waves-effect">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH DATA PENGELUARAN</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <!-- TABEL DATA PENGELUARAN LANGSUNG -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Biaya</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Biaya</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($directExp as $de)
                                        <tr>
                                            <td>{{ $de->nama }}</td>
                                            <td>@currency($de->biaya)</td>
                                            <td>{{ $de->deskripsi }}</td>
                                            <td>
                                                <button onclick="window.location.href='{{ route('direct-exps.edit', $de->id) }}';"
                                                        class="btn btn-warning waves-effect m-b-10 m-l-5" type="button"
                                                        data-toggle="tooltip" data-placement="bottom" title="Pengaturan {{ $de->nama }}">
                                                    <i class="material-icons">settings</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# TABEL DATA PENGELUARAN LANGSUNG -->
            </div>
        </div>
    </section>
@endsection
