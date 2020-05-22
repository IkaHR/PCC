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
                                @include('usahas.form')
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" class="btn btn-primary waves-effect" value="Simpan Perubahan"></input>&nbsp;
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