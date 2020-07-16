@extends('layouts.header')

@section('title', 'Dashboard')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">DASHBOARD</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-indigo hover-zoom-effect" style="cursor:pointer;" onclick="window.location.href='{{ route('produk.index') }}';">
                        <div class="icon">
                            <i class="material-icons">layers</i>
                        </div>
                        <div class="content">
                            <div class="text">PRODUK/LAYANAN</div>
                            <div class="number count-to" data-from="0" data-to="{{ $datausaha->produks->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-teal hover-zoom-effect" style="cursor:pointer;" onclick="window.location.href='{{ route('resource.index') }}';">
                        <div class="icon">
                            <i class="material-icons">donut_small</i>
                        </div>
                        <div class="content">
                            <div class="text">RESOURCES</div>
                            <div class="number count-to" data-from="0" data-to="{{ $datausaha->resources->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-green hover-zoom-effect" style="cursor:pointer;" onclick="window.location.href='{{ route('act.index') }}';">
                        <div class="icon">
                            <i class="material-icons">data_usage</i>
                        </div>
                        <div class="content">
                            <div class="text">AKTIVITAS USAHA</div>
                            <div class="number count-to" data-from="0" data-to="{{ $datausaha->acts->count() }}" data-speed="1500" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-zoom-effect" style="cursor:pointer;" onclick="window.location.href='{{ route('direct-exp.index') }}';">
                        <div class="icon">
                            <i class="material-icons">monetization_on</i>
                        </div>
                        <div class="content">
                            <div class="text">P. LANGSUNG</div>
                            <div class="number count-to" data-from="0" data-to="{{ $datausaha->directExps->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
