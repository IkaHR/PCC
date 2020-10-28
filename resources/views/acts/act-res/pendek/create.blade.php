@extends('layouts.header')

@section('title', 'Resource Aktivitas')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <div class="media-body">
                                <h4 class="media-heading">RESOURCE DALAM <b>{{ strtoupper($act -> nama) }}</b></h4>
                                <small>Pilihlah salah satu dari daftar <b>resource jangka pendek</b> yang tersedia.</small>
                            </div>
                        </div>
                        <div class="body">
                            <form class="form-horizontal"  method="post" action="{{ route('act-res.store') }}" autocomplete="on">
                                @include('acts.act-res.pendek.form')
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" class="btn btn-primary waves-effect" value="Simpan">&nbsp;
                                        <a href="{{ url()->previous() }}" class="btn btn-danger waves-effect">BATAL</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal" style="text-align: center;">
                            <h4><b>RESOURCE TIDAK DITEMUKAN?</b></h4>
                            Apabila Anda kesulitan dalam mencari resource yang dibutuhkan, Anda dapat:
                            <button class="btn btn-block btn-lg btn-default waves-effect m-t-10 m-b-10"
                                    onclick="window.location.href='{{ route('resources.index') }}?a={{ $act -> id }}';">
                                <b>LIHAT DAFTAR SEMUA RESOURCE</b>
                            </button>
                            <span>atau</span>
                            <button class="btn btn-block btn-lg btn-default waves-effect m-t-10 m-b-10"
                                    onclick="window.location.href='{{ route('resources.create') }}?a={{ $act -> id }}&r=2';">
                                <b>BUAT RESOURCE JANGKA PENDEK BARU</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection