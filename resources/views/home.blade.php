@extends('layouts.header')

@section('title', 'Home')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.homesidebar')

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

            <div class="row clearfix">
            <!-- TABEL DAFTAR BADAN USAHA -->
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
                                                    <li class="list-group-item"><b>No. Telp: </b>{{ $u->phone ?? '-'}}</li>
                                                    <li class="list-group-item"><b>Email: </b>{{ $u->email ?? '-'}}</li>
                                                    <li class="list-group-item"><b>Alamat: </b>{{ $u->alamat ?? '-'}}</li>
                                                    <li class="list-group-item"><b>Deskripsi: </b>{{ $u->deskripsi ?? '-'}}</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="list-group">
                                                    <button onclick="window.location.href='{{ route('dashboard') }}?u={{ $u->id }}';" class="list-group-item btn bg-cyan">
                                                        <i class="material-icons">dashboard</i>
                                                        <span>Buka Dashboard</span>
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
