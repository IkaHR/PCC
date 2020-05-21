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
                        <a href="{{ route('usaha.create') }}" class="btn btn-block btn-lg btn-success waves-effect">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH PRODUK/LAYANAN</span>
                        </a>
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
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Badan Usaha</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>tes</td>
                                            <td>tes</td>
                                            <td>
                                            <a href="" class="btn bg-cyan waves-effect">
                                                <i class="material-icons">dashboard</i>
                                                <span>Dashboard</span>
                                            </a>&nbsp;
                                            <a href="" class="btn btn-warning waves-effect">
                                                <i class="material-icons">mode_edit</i>
                                                <span>Edit Profil Usaha</span>
                                            </a>
                                            </td>
                                        </tr>
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