@extends('layouts.header')

@section('title', 'Pengaturan')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <!--EDIT PROFIL USAHA-->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT PROFIL BADAN USAHA
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal"  method="post" action="{{ route('usaha.update', $usaha->id) }}">
                            @method('PUT')
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Nama Badan Usaha</label>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="nama" class="form-control" placeholder="Masukkan nama Badan Usaha" value="{{ $usaha -> nama }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>No. Telp</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="tel" name="phone" class="form-control" placeholder="-" value="{{ $usaha -> phone }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Email</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="email" name="email" class="form-control" placeholder="-" value="{{ $usaha -> email }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Alamat</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="alamat" class="form-control" placeholder="-" value="{{ $usaha -> alamat }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label>Deskripsi</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-line">
                                            <textarea name="deskripsi" rows="3" class="form-control no-resize" placeholder="-"> {{ $usaha -> deskripsi }} </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" class="btn btn-primary waves-effect" value="Simpan"></input>&nbsp;
                                        <a href="{{ asset('/home')}}" class="btn btn-danger waves-effect">BATAL</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- #END# EDIT PROFIL USAHA-->

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                HAPUS DATA BADAN USAHA
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal" method="post" action="{{ route('usaha.destroy', $usaha->id) }}">
                                @method('DELETE')
                                @csrf
                                <input type="submit" class="btn bg-red waves-effect" value="HAPUS DATA BADAN USAHA"></input>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection