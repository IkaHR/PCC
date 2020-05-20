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
                        <button class="btn btn-block btn-lg btn-success waves-effect">
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
                                            <td>Tiger Nixon</td>
                                            <td>System Architect System Architect System Architect </td>
                                            <td>
                                            <button class="btn bg-cyan waves-effect">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Dashboard</span>
                                            </button>&nbsp;
                                            <button class="btn btn-warning waves-effect">
                                                <i class="material-icons">mode_edit</i>
                                                <span>Edit Profil</span>
                                            </button>&nbsp;
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