@extends('layouts.header')

@section('title', 'Home')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.homesidebar')
    
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">BADAN USAHA</h4> 
                        <small>Daftar Badan Usaha yang Ditangani. </small>
                    </div>
                    <div class="media-right">
                        <a href="{{ route('usaha.create') }}" class="btn btn-block btn-lg btn-success waves-effect">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH BADAN USAHA</span>
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
                                    @foreach($usaha as $u)
                                        <tr>
                                            <td>{{ $u->nama }}</td>
                                            <td>{{ $u->deskripsi }}</td>
                                            <td>
                                            <a href="" class="btn bg-cyan waves-effect">
                                                <i class="material-icons">layers</i>
                                                <span>Produk/Layanan</span>
                                            </a>&nbsp;
                                            <a href="" class="btn bg-green waves-effect">
                                                <i class="material-icons">donut_small</i>
                                                <span>Resource</span>
                                            </a>&nbsp;
                                            <a href="{{ route('usaha.edit', $u->id) }}" class="btn btn-warning waves-effect">
                                                <i class="material-icons">settings</i>
                                                <span>Pengaturan</span>
                                            </a>
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