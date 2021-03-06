@extends('layouts.header')

@section('title', 'Edit Profil')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.homesidebar')

    <section class="content">
        <div class="container-fluid">

            @include('layouts.notification')

            <!-- Tabs With Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs  -->
                            <ul class="nav nav-tabs tab-col-teal" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#profil" data-toggle="tab">
                                        <i class="material-icons">account_circle</i>
                                        <b>EDIT PROFIL PENGGUNA</b>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#password" data-toggle="tab">
                                        <i class="material-icons">lock</i>
                                        <b>GANTI PASSWORD</b>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="profil">
                                    <div class="p-t-10">
                                        <form enctype="multipart/form-data" class="form-horizontal"  method="post" action="{{ route('profiles.update', Auth::user()->id) }}" autocomplete="off">
                                            @method('PUT')
                                            @csrf
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label>Email</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="email" name="email" class="form-control" placeholder="Opsional" value="{{ Auth::user()->email }}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label>Nama Lengkap</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="text" name="name" class="form-control" placeholder="Masukkan nama Badan Usaha" value="{{ Auth::user()->name }}" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label>Ganti Foto Profil</label>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="file" name="avatar" accept="image/*" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                    <input type="submit" class="btn btn-primary waves-effect" value="Simpan Perubahan">&nbsp;
                                                    <a href="{{ asset('/home')}}" class="btn btn-danger waves-effect">BATAL dan Kembali ke Home</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="password">
                                    <div class="p-t-10">
                                        <form class="form-horizontal"  method="post" action="{{ route('profiles.changepass') }}" autocomplete="off">
                                            @method('PUT')
                                            @csrf
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label>Password Lama</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="password" name="old_pass" class="form-control" placeholder="Masukkan password lama" minlength="8" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label>Password Baru</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="password" name="new_pass" class="form-control" placeholder="Masukkan password baru" minlength="8" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                    <label>Konfirmasi Password Baru</label>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <input type="password" name="conf_pass" class="form-control" placeholder="Masukkan kembali password" minlength="8" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                                    <input type="submit" class="btn btn-primary waves-effect" value="Simpan Perubahan">&nbsp;
                                                    <a href="{{ asset('/home')}}" class="btn btn-danger waves-effect">BATAL dan Kembali ke Home</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Icon Title -->
        </div>
    </section>
@endsection
