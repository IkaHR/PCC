@extends('layouts.header')

@section('title', 'Aktivitas Produksi')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">

            @if (session()-> has('notif'))
                <div class="alert bg-teal alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session()->get('notif') }}
                </div>
            @endif

            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">DATA AKTIVITAS PRODUKSI</h4>
                        <small>Daftar aktivitas produksi yang dilakukan oleh {{ $datausaha -> nama }}</small>
                    </div>
                    <div class="media-right">
                        <button onclick="window.location.href='{{ route('act.create') }}';" class="btn btn-block btn-lg btn-success waves-effect">
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
                                        <th>Sub Aktivitas</th>
                                        <th>TMU</th>
                                        <th>F</th>
                                        <th>T (s)</th>
                                        <th>Total T (m)</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Sub Aktivitas</th>
                                        <th>TMU</th>
                                        <th>F</th>
                                        <th>T (s)</th>
                                        <th>Total T (m)</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($act as $a)
                                        <tr>
                                            <td>{{ $a->nama }}</td>
                                            <td>
                                                <ul class="list-group">
                                                    @foreach($a->sub_acts as $sub)
                                                        <li class="list-group-item">{{ $sub->detail ?? '-'}}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-group">
                                                    @foreach($a->sub_acts as $sub)
                                                        <li class="list-group-item">{{ ($sub->idx)*10 ?? '-'}}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-group">
                                                    @foreach($a->sub_acts as $sub)
                                                        <li class="list-group-item">{{ ($sub->frekuensi) ?? '-'}}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                <ul class="list-group">
                                                    @foreach($a->sub_acts as $sub)
                                                        <li class="list-group-item">{{ (($sub->idx)*($sub->frekuensi))*0.36 ?? '-'}}</li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td>
                                                {{ $a->sub_acts->sum('idx')*0.006 }}
                                            </td>
                                            <td>
                                                <button onclick="window.location.href='{{ route('act.edit', $a->id) }}';" class="btn btn-warning waves-effect">
                                                    <i class="material-icons">settings</i>
                                                    <span>Pengaturan</span>
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