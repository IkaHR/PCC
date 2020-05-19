@extends('layouts.header')

@section('title', 'Home')

@section('content')

    <aside id="leftsidebar" class="sidebar">
        <div class="card profile-card">
            <div class="profile-header">&nbsp;</div>
            <div class="profile-body">
                <div class="image-area">
                    <img src="{{ asset('images/user-lg.jpg') }}" alt="Profile Image" />
                </div>
                <div class="content-area">
                    <h3>{{ Auth::user()->name }}</h3>
                    <p>{{ Auth::user()->email }}</p>
                    <p>Akuntan</p>
                </div>
            </div>
            <div class="profile-footer">
                <ul>
                    <li>
                        <span>Badan Usaha ditangani</span>
                        <span>1.234</span>
                    </li>
                    <li>
                        <span>Produk dihitung</span>
                        <span>1.201</span>
                    </li>
                </ul>
                <a class="btn btn-block btn-lg btn-success waves-effect" href="#">
                <i class="material-icons">settings</i>
                <span>Setting</span>
                </a>
                <a class="btn btn-block btn-lg btn-danger waves-effect"
                    href="{{ route('logout') }}" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>{{ __('Logout') }}</span>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
        </div>
    </aside>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">BADAN USAHA</h4> 
                        <small>Daftar Badan Usaha yang Ditangani. </small>
                    </div>
                    <div class="media-right">
                        <button class="btn btn-block btn-lg btn-success waves-effect" data-toggle="modal" data-target="#TambahUsaha">
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
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabel">
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
                                            <td>System Architect System Architect System Architect System Architect System</td>
                                            <td>&nbsp;
                                            <button class="btn bg-cyan waves-effect" data-toggle="modal" data-target="#show">
                                                <i class="material-icons">remove_red_eye</i>
                                                <span>Lihat</span>
                                            </button>&nbsp;
                                            <button class="btn btn-warning waves-effect" data-toggle="modal" data-target="#popup">
                                                <i class="material-icons">mode_edit</i>
                                                <span>Edit</span>
                                            </button>&nbsp;
                                            <button class="btn bg-red waves-effect" data-toggle="modal" data-target="#popup">
                                                <i class="material-icons">delete</i>
                                                <span>Hapus</span>
                                            </button>
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

    <!-- Modal #TambahUsaha-->
    <div class="modal fade" id="TambahUsaha" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg card">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body body">
                <form class="form-horizontal">
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="email_address_2">Email Address</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" id="email_address_2" class="form-control" placeholder="Enter your email address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                            <label for="password_2">Password</label>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" id="password_2" class="form-control" placeholder="Enter your password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                            <button type="button" class="btn btn-primary m-t-15 waves-effect">LOGIN</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect"  data-dismiss="modal">
                    <i class="material-icons">delete</i>
                    <span>BATAL</span>
                </button>
            </div>
            </div>
        </div>
    </div>
    <!-- #END# Modal #TambahUsaha-->

@endsection