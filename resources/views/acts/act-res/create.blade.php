@extends('layouts.header')

@section('title', 'Resource Aktivitas')

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
                                <h4 class="media-heading">RESOURCE DI <span style="color: #009688">{{ strtoupper($act -> nama) }}</span></h4>
                                <small>Pilihlah salah satu dari daftar <b>resource</b> yang tersedia.</small>
                            </div>
                        </div>
                        <div class="body">
                            <form class="form-horizontal"  method="post" action="{{ route('act-res.store') }}" autocomplete="on">
                                @include('acts.act-res.form')
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" class="btn btn-primary waves-effect" value="Simpan">&nbsp;
                                        <a href="{{ asset('/acts/'.$act -> id.'/edit') }}" class="btn btn-danger waves-effect">BATAL</a>
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
                                    onclick="window.location.href='{{ route('resources.create') }}';">
                                <b>Buat data RESOURCE baru</b>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
