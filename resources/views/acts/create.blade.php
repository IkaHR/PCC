@extends('layouts.header')

@section('title', 'Aktivitas Produksi')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                DATA AKTIVITAS PRODUKSI
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal"  method="post" action="{{ route('acts.store') }}" autocomplete="on">
                                @include('acts.form')
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" class="btn btn-primary waves-effect" value="Lanjutkan">&nbsp;
                                        @if(session()->has('p'))
                                            <a href="{{ asset('/produks/'.session('p').'/edit') }}" class="btn btn-danger waves-effect">BATAL & KEMBALI KE DATA PRODUK</a>
                                        @else
                                            <a href="{{ asset('/acts') }}" class="btn btn-danger waves-effect">BATAL</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
