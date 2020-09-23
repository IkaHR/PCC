@extends('layouts.header')

@section('title', 'Resources')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">
            <!-- Notification -->
            @if (session()-> has('notif'))
                <div class="alert bg-teal alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session()->get('notif') }}
                </div>
            @endif
            @if (session()-> has('error'))
                <div class="alert bg-red alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session()->get('error') }}
                </div>
            @endif
            <!-- #END# Notification -->
            <!-- Tabs With Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <!-- Nav tabs  -->
                            <ul class="nav nav-tabs tab-col-teal" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#resources_jangka_panjang" data-toggle="tab">
                                        <b>RESOURCES JANGKA PANJANG</b>
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#resources_jangka_pendek" data-toggle="tab">
                                        <b>RESOURCES JANGKA PENDEK</b>
                                    </a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="resources_jangka_panjang">
                                    <div class="block-header p-t-10">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="media-heading">Fungsional Minimal 1 Tahun / Lebih</h4>
                                                <small>Daftar sumber daya dengan umur ekonomis minimal 1 tahun / lebih yang dimiliki oleh {{ $datausaha -> nama }}</small>
                                            </div>
                                            <div class="media-right">
                                                <button onclick="window.location.href='{{ route('resources.create') }}?r=1';" class="btn btn-block btn-lg btn-success waves-effect">
                                                    <i class="material-icons">add_box</i>
                                                    <span>TAMBAH RESOURCE JANGKA PANJANG</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Qt</th>
                                                <th>Umur</th>
                                                <th>Biaya</th>
                                                <th>Perawatan/tahun</th>
                                                <th>Total/tahun</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Qt</th>
                                                <th>Umur</th>
                                                <th>Biaya</th>
                                                <th>Perawatan/tahun</th>
                                                <th>Total/tahun</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            @foreach($resource_panjang as $r1)
                                                <tr>
                                                    <td>{{ $r1->nama }}</td>
                                                    <td>{{ $r1->kuantitas }}</td>
                                                    <td><b>{{ $r1->umur }}</b><span style="color: #f65d20"> tahun</span></td>
                                                    <td>@currency($r1->biaya)</td>
                                                    <td>@currency($r1->perawatan)</td>
                                                    <td>@currency($r1->pertahun)</td>
                                                    <td>{{ $r1->deskripsi }}</td>
                                                    <td>
                                                        <button onclick="window.location.href='{{ route('resources.edit', $r1->id) }}?r=1';" class="btn btn-warning waves-effect">
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
                                <div role="tabpanel" class="tab-pane fade" id="resources_jangka_pendek">
                                    <div class="block-header p-t-10">
                                        <div class="media">
                                            <div class="media-body">
                                                <h4 class="media-heading">Fungsional Kurang dari 1 Tahun</h4>
                                                <small>Daftar sumber daya dengan umur ekonomis kurang dari 1 tahun yang dimiliki oleh {{ $datausaha -> nama }}</small>
                                            </div>
                                            <div class="media-right">
                                                <button onclick="window.location.href='{{ route('resources.create') }}?r=2';" class="btn btn-block btn-lg btn-success waves-effect">
                                                    <i class="material-icons">add_box</i>
                                                    <span>TAMBAH RESOURCE JANGKA PENDEK</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                            <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Anggaran/tahun</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Anggaran/tahun</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            @foreach($resource_pendek as $r2)
                                                <tr>
                                                    <td>{{ $r2->nama }}</td>
                                                    <td>@currency($r2->biaya)</td>
                                                    <td>{{ $r2->deskripsi }}</td>
                                                    <td>
                                                        <button onclick="window.location.href='{{ route('resources.edit', $r2->id) }}?r=2';" class="btn btn-warning waves-effect">
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
                    </div>
                </div>
            </div>
            <!-- #END# Tabs With Icon Title -->
        </div>
    </section>
@endsection
