@extends('layouts.header')

@section('title', 'Home')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.homesidebar')

    <section class="content">
        <div class="container-fluid">

            @include('layouts.notification')

            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">BADAN USAHA</h4>
                        <small>Daftar Badan Usaha yang Ditangani. </small>
                    </div>
                    <div class="media-right">
                        <button onclick="window.location.href='{{ route('usahas.create') }}';" class="btn btn-block btn-lg btn-success waves-effect">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH BADAN USAHA</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- TABEL DAFTAR BADAN USAHA -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nama Badan Usaha</th>
                                            <th>Informasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Badan Usaha</th>
                                            <th>Informasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($usaha as $u)
                                        <tr>
                                            <td>{{ $u->nama }}</td>
                                            <td>
                                                <ul class="list-group">
                                                    @if($u->phone != null)
                                                        <li class="list-group-item"><b>No. Telp: </b>{{ $u->phone }}</li>
                                                    @endif
                                                    @if($u->email != null)
                                                        <li class="list-group-item"><b>Email: </b>{{ $u->email }}</li>
                                                    @endif
                                                    @if($u->alamat != null)
                                                        <li class="list-group-item"><b>Alamat: </b>{{ $u->alamat }}</li>
                                                    @endif
                                                    @if($u->deskripsi != null)
                                                        <li class="list-group-item"><b>Deskripsi: </b>{{ $u->deskripsi }}</li>
                                                    @endif
                                                </ul>
                                            </td>
                                            <td class="col-sm-4">
                                                <div class="icon-button-demo">
                                                    <button onclick="window.location.href='{{ route('dashboard') }}?u={{ $u->id }}';"
                                                            class="btn btn-block bg-pink waves-effect m-b-10">
                                                        <i class="material-icons">dashboard</i>
                                                        <span>Buka Dashboard</span>
                                                    </button>
                                                    <button onclick="window.location.href='{{ route('produks.index') }}?u={{ $u->id }}';"
                                                            type="button" class="btn bg-indigo waves-effect m-b-10 m-l-5"
                                                            data-toggle="tooltip" data-placement="bottom" title="Produk/Layanan">
                                                        <i class="material-icons">layers</i>
                                                    </button>
                                                    <button onclick="window.location.href='{{ route('resources.index') }}?u={{ $u->id }}';"
                                                            type="button" class="btn bg-teal waves-effect m-b-10 m-l-5"
                                                            data-toggle="tooltip" data-placement="bottom" title="Data Resources">
                                                        <i class="material-icons">donut_small</i>
                                                    </button>
                                                    <button onclick="window.location.href='{{ route('acts.index') }}?u={{ $u->id }}';"
                                                            type="button" class="btn bg-green waves-effect m-b-10 m-l-5"
                                                            data-toggle="tooltip" data-placement="bottom" title="Aktivitas Usaha">
                                                        <i class="material-icons">data_usage</i>
                                                    </button>
                                                    <button onclick="window.location.href='{{ route('direct-exps.index') }}?u={{ $u->id }}';"
                                                            type="button" class="btn bg-light-green waves-effect m-b-10 m-l-5"
                                                            data-toggle="tooltip" data-placement="bottom" title="Pengeluaran Langsung">
                                                        <i class="material-icons">monetization_on</i>
                                                    </button>
                                                    <button onclick="window.location.href='{{ route('usahas.edit', $u->id) }}?u={{ $u->id }}';"
                                                            type="button" class="btn bg-cyan waves-effect m-b-10 m-l-5"
                                                            data-toggle="tooltip" data-placement="bottom" title="Profil Usaha">
                                                        <i class="material-icons">work</i>
                                                    </button>
                                                </div>
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
            <!-- #END# TABEL DAFTAR BADAN USAHA -->
        </div>
    </section>

@endsection
