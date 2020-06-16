@extends('layouts.header')

@section('title', 'Aktivitas Produksi')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">

                <!-- TABEL DAFTAR SUB AKTIVITAS -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">

                        @if (session()-> has('notif'))
                            <div class="alert bg-teal alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ session()->get('notif') }}
                            </div>
                        @endif

                        <div class="header">
                            <div class="media-body">
                                <h4 class="media-heading">DAFTAR SUB-AKTIVITAS</h4>
                                <small>Detail dari aktivitas yang dilakukan dalam proses {{ $act->nama }}</small>
                            </div>
                            <div class="media-right">
                                <button onclick="window.location.href='{{ route('sub.create') }}?a={{ $act->id }}';" class="btn btn-block btn-lg btn-success waves-effect">
                                    <i class="material-icons">add_box</i>
                                    <span>TAMBAH SUB-AKTIVITAS</span>
                                </button>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Detail</th>
                                        <th>index</th>
                                        <th>TMU</th>
                                        <th>Frekuensi</th>
                                        <th>Total Waktu (s)</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Detail</th>
                                        <th>index</th>
                                        <th>TMU</th>
                                        <th>Frekuensi</th>
                                        <th>Total Waktu (s)</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($datasub as $sub)
                                        <tr>
                                            <td>{{ $sub->detail }}</td>
                                            <td>{{ $sub->idx }}</td>
                                            <td>{{ $sub->tmu }}</td>
                                            <td>{{ $sub->frekuensi }}</td>
                                            <td>{{ $sub->detik }}</td>
                                            <td>
                                                <button onclick="window.location.href='{{ route('sub.edit' , $sub -> id) }}?a={{ $act->id }}';" class="btn btn-warning waves-effect">
                                                    <i class="material-icons">edit</i>
                                                    <span>Edit</span>
                                                </button>&nbsp;
                                                <button class="btn btn-danger waves-effect" type="submit" form="hapus" value="Submit">
                                                    <i class="material-icons">delete</i>
                                                    <span>Hapus</span>
                                                </button>&nbsp;
                                                <form class="form-horizontal" method="post" action="{{ route('sub.destroy', $sub->id) }}" id="hapus">
                                                    @method('DELETE')
                                                    @csrf
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# TABEL DAFTAR SUB AKTIVITAS -->

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT DATA AKTIVITAS
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal"  method="post" action="{{ route('act.update', $act->id) }}" autocomplete="off">
                                @method('PUT')
                                @include('acts.form')
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" class="btn btn-primary waves-effect" value="Simpan Perubahan">&nbsp;
                                        <a href="{{ asset('/act')}}" class="btn btn-danger waves-effect">BATAL</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="hapus">
                    <div class="card">
                        <div class="header">
                            <h2>
                                HAPUS DATA AKTIVITAS
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
                    <h4 class="modal-title" id="defaultModalLabel">Hapus Semua Data {{ $act->nama }} ?</h4>
                </div>
                <div class="modal-body">
                    <p>Semua data yang berhubungan dengan {{ $act->nama }} juga akan terhapus secara permanen! </p>
                </div>
                <div class="modal-footer">
                    <form class="form-horizontal" method="post" action="{{ route('act.destroy', $act->id) }}">
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