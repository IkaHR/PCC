@extends('layouts.header')

@section('title', 'Resources')

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
                                EDIT DATA RESOURCES
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal"  method="post" action="{{ route('resources.update', $resource->id) }}" autocomplete="off">
                            @method('PUT')
                                @include('resources.form')
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" class="btn btn-primary waves-effect" value="Simpan Perubahan">&nbsp;
                                        <a href="{{ asset('/resources') }}" class="btn btn-danger waves-effect">BATAL</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                HAPUS DATA RESOURCE
                            </h2>
                        </div>
                        <div class="body">
                            <button type="button" class="btn bg-red waves-effect" data-toggle="modal" data-target="#defaultModal">HAPUS DATA RESOURCE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Penghapusan Data -->
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Hapus Data {{ $resource->nama }} ?</h4>
                </div>
                <div class="modal-body">
                    <p>Data yang berelasi dengan {{ $resource->nama }} juga akan mengalami perubahan! </p>
                </div>
                <div class="modal-footer">
                    <form class="form-horizontal" method="post" action="{{ route('resources.destroy', $resource->id) }}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn bg-red waves-effect" value="HAPUS DATA">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATALKAN PENGHAPUSAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
