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

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
