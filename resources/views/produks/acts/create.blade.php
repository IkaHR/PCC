@extends('layouts.header')

@section('title', 'Aktivitas Produksi')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">

            @include('layouts.notification')

            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <div class="media-body">
                                <h4 class="media-heading">AKTIVITAS DALAM <b>{{ strtoupper($produk -> nama) }}</b></h4>
                                <small>Pilihlah salah satu dari daftar <b>aktivitas</b> yang tersedia.</small>
                            </div>
                        </div>
                        <div class="body">
                            <form class="form-horizontal"  method="post" action="{{ route('act-pro.store') }}" autocomplete="off">
                                @include('produks.acts.form')
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" class="btn btn-primary waves-effect" value="Simpan">&nbsp;
                                        <a href="{{ asset('/produks/'.$produk -> id.'/edit') }}" class="btn btn-danger waves-effect">BATAL</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal" style="text-align: center;">
                            <h4><b>AKTIVITAS TIDAK DITEMUKAN?</b></h4>
                            Apabila Anda kesulitan dalam mencari aktivitas yang dibutuhkan, Anda dapat:
                            <button class="btn btn-block btn-lg btn-default waves-effect m-t-10 m-b-10"
                                    onclick="window.location.href='{{ route('acts.create') }}';">
                                <b>Buat AKTIVITAS USAHA baru</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
