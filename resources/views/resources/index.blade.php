@extends('layouts.header')

@section('title', 'Resources')

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
                        <h4 class="media-heading">DATA RESOURCES</h4>
                        <small>Daftar sumber daya yang dimiliki oleh {{ $datausaha -> nama }}</small>
                    </div>
                    <div class="media-right">
                        <button onclick="window.location.href='{{ route('resource.create') }}';" class="btn btn-block btn-lg btn-success waves-effect">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH RESOURCE</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <!-- TABEL DAFTAR RESOURCES -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kuantitas</th>
                                        <th>Umur Ekonomis (thn)</th>
                                        <th>Biaya (Rp/thn)</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kuantitas</th>
                                        <th>Umur Ekonomis (thn)</th>
                                        <th>Biaya (Rp/thn)</th>
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
                                            <td>{{ $r->biaya }}</td>
                                            <td>{{ $r->deskripsi }}</td>
                                            <td>
                                                <button onclick="window.location.href='{{ route('resource.edit', $r->id) }}';" class="btn btn-warning waves-effect">
                                                    <i class="material-icons">settings</i>
                                                    <span>Pengaturan</span>
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
            <!-- #END# TABEL DAFTAR RESOURCES -->
        </div>
    </section>
@endsection
