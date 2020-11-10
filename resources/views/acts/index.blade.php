@extends('layouts.header')

@section('title', 'Aktivitas Produksi')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">

            @include('layouts.notification')

            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">DATA AKTIVITAS PRODUKSI</h4>
                        <small>Daftar aktivitas produksi yang dilakukan oleh {{ $datausaha -> nama }}</small>
                    </div>
                    <div class="media-right">
                        <button onclick="window.location.href='{{ route('acts.create') }}';" class="btn btn-block btn-lg btn-success waves-effect">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH AKTIVITAS</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <!-- TABEL DAFTAR AKTIVITAS -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>TMU</th>
                                        <th>Practical Capacity (menit)</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>TMU</th>
                                        <th>Practical Capacity (menit)</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($act as $a)
                                        <tr>
                                            <td>{{ $a->nama }}</td>
                                            <td>{{ $a->totalTMU }}</td>
                                            <td>{{ $a->menit }}</td>
                                            <td>
                                                <b>{{ $a->sub_acts->count() }}</b>
                                                <span style="color: #f65d20">Sub-aktivitas</span> &
                                                <br>
                                                <b>{{ $a->resources->count() }}</b>
                                                <span style="color: #f65d20">Resources digunakan</span>
                                            </td>
                                            <td>
                                                <button onclick="window.location.href='{{ route('acts.edit', $a->id) }}';"
                                                        class="btn btn-warning waves-effect" type="button"
                                                        data-toggle="tooltip" data-placement="bottom" title="Pengaturan {{ $a->nama }}">
                                                    <i class="material-icons">settings</i>
                                                </button>&nbsp;
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# TABEL DAFTAR AKTIVITAS -->
            </div>
        </div>
    </section>
@endsection
