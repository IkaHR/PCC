@extends('layouts.header')

@section('title', 'Aktivitas Produksi')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                
                @if(session()->has('p'))
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue-grey">
                            <div class="media-body">
                                <h4 class="media-heading">HUBUNGKAN KE <span style="color: #ffe821">{{ strtoupper($produk -> nama) }}</span></h4>
                                <small>Pastikan Anda telah mengisi daftar Sub-Aktivitas & Resource pada aktivitas ini</small>
                            </div>
                            <div class="media-right">
                                @if($act->sub_acts->count() != 0 && $act->resources->count() != 0)
                                    <button onclick="window.location.href='{{ asset('/act-pro/create?aid='.$act->id) }}';"
                                            class="btn btn-block btn-lg btn-warning waves-effect">
                                        <i class="material-icons">add_box</i>
                                        <span>HUBUNGKAN SEKARANG</span>
                                    </button>
                                @else
                                    <button class="btn btn-block btn-lg btn-warning waves-effect" disabled="disabled">
                                        <i class="material-icons">add_box</i>
                                        <span>HUBUNGKAN SEKARANG</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif
				
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('layouts.notification')
                </div>

                <!-- TABEL DAFTAR SUB AKTIVITAS -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="sub">
                    <div class="card">
                        <div class="header">
                            <div class="media-body">
                                <h4 class="media-heading">DAFTAR SUB-AKTIVITAS</h4>
                                <small>Detail dari aktivitas yang dilakukan dalam aktivitas <span style="color: #009688">{{ $act->nama }}</span></small>
                            </div>
                            <div class="media-right">
                                <button onclick="window.location.href='{{ route('subs.create') }}';" class="btn btn-block btn-lg btn-success waves-effect">
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
                                        <th>#</th>
                                        <th>Detail</th>
                                        <th>index</th>
                                        <th>TMU</th>
                                        <th>Total Waktu<br>(detik)</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Detail</th>
                                        <th>index</th>
                                        <th>TMU</th>
                                        <th>Total Waktu<br>(detik)</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($sub as $s)
                                        <tr>
                                            <td>{{ $s->created_at }}</td>
                                            <td>{{ $s->detail }}</td>
                                            <td>{{ $s->idx }}</td>
                                            <td>{{ $s->tmu }}</td>
                                            <td>{{ $s->detik }}</td>
                                            <td>
                                                <button onclick="window.location.href='{{ route('subs.edit' , $s -> id) }}?a={{ $act->id }}';"
                                                        class="btn btn-warning waves-effect m-b-10 m-l-5">
                                                    <i class="material-icons">edit</i>
                                                </button>
                                                <button class="btn btn-danger waves-effect m-b-10 m-l-5"
                                                        data-id="{{ $s -> id }}"
                                                        data-detail="{{ $s -> detail }}"
                                                        data-toggle="modal"
                                                        data-target="#deleteSubAct">
                                                    <i class="material-icons">delete</i>
                                                </button>
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
                    @include('layouts.notification2')
                </div>
				
				<!-- TABEL RESOURCE YANG BERHUBUNGAN -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="res">
                    <div class="card">
                        <div class="header">
                            <div class="media-body">
                                <h4 class="media-heading">DAFTAR RESOURCES</h4>
                                <small>Detail dari resource yang digunakan dalam aktivitas <span style="color: #009688">{{ $act->nama }}</span></small>
                            </div>
                            <div class="media-right">
                                <button class="btn btn-block btn-lg btn-warning waves-effect"
                                        onclick="window.location.href='{{ route('act-res.create') }}';">
                                    <i class="material-icons">add_box</i>
                                    <span>PILIH RESOURCES</span>
                                </button>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kuantitas<br>Tersedia</th>
                                        <th>Kuantitas<br>Digunakan</th>
                                        <th>CDR Unit<br>(per menit)</th>
                                        <th>Total Biaya<br>(per menit)</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Kuantitas<br>Tersedia</th>
                                        <th>Kuantitas<br>Digunakan</th>
                                        <th>CDR Unit<br>(per menit)</th>
                                        <th>Total Biaya<br>(per menit)</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($act->resources as $r)

                                        @php($res = \App\Resource::ResourceDiBlade($r->id))

                                        <tr>
                                            <td>{{ $r->nama }}</td>
                                            <td>{{ $r->kuantitas }}</td>
                                            <td>{{ $r->pivot->kuantitas }}</td>
                                            <td>@currency($res->permenit)</td>
                                            <td>@currency($res->permenit * $r->pivot->kuantitas)</td>
                                            <td>
                                                <form class="form-horizontal"  method="post" action="{{ route('act-res.destroy', 'detach') }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="resource_id" value="{{ $r -> id }}"/>
                                                    <input type="hidden" name="act_id" value="{{ $act -> id }}"/>
                                                    <input type="submit" class="btn btn-warning waves-effect" value="Hapus dari Aktivitas">&nbsp;
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
                <!-- #END# TABEL RESOURCE YANG BERHUBUNGAN -->

                <!-- GANTI DETAIL NAMA AKTIVITAS -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                GANTI NAMA AKTIVITAS
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal"  method="post" action="{{ route('acts.update', $act->id) }}" autocomplete="on">
                                @method('PUT')
                                @include('acts.form')
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" class="btn btn-primary waves-effect" value="Simpan Perubahan">&nbsp;
                                        <a href="{{ asset('/acts')}}" class="btn btn-danger waves-effect">BATAL</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- #END# GANTI DETAIL NAMA AKTIVITAS -->

                <!-- HAPUS AKTIVITAS -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                HAPUS DATA AKTIVITAS
                            </h2>
                        </div>
                        <div class="body" id="setting">
                            <button type="button" class="btn bg-red waves-effect" data-toggle="modal"
                                    data-target="#deleteAll">HAPUS DATA RESOURCE
                            </button>
                        </div>
                    </div>
                </div>
                <!-- #END# HAPUS AKTIVITAS -->
            </div>
        </div>
    </section>

    <!-- Modal Penghapusan Data Aktivitas + semua Sub-Aktivitasnya -->
    <div class="modal fade" id="deleteAll" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Hapus Semua Data {{ $act->nama }} ?</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <b>Data Sub-Aktivitas</b> yang berhubungan dengan aktivitas {{ $act->nama }}
                        <b>akan</b> ikut terhapus. Akan tetapi, data <b>Resource</b> yang berhubungan
                        <b>tidak akan</b> ikut terhapus. Anda dapat menghapus data-data Resource
                        dengan mengaksesnya pada menu Resource.
                    </p>
                </div>
                <div class="modal-footer">
                    <form class="form-horizontal" method="post" action="{{ route('acts.destroy', $act->id) }}">
                        @method('DELETE')
                        @csrf
                        <input type="submit" class="btn btn-danger waves-effect" value="HAPUS DATA">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATALKAN PENGHAPUSAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Modal Penghapusan Data Aktivitas + semua Sub-Aktivitasnya -->

    <!-- Modal Penghapusan Data Sub-Aktivitas -->
    <div class="modal fade" id="deleteSubAct" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Hapus Data ?</h4>
                </div>
                <div class="modal-body">
                    Dengan menghapus data <b>SUB-AKTIVITAS</b>, data yang berelasi akan mengalami perubahan!
                    <input type="text" name="detail" id="detail" class="form-control m-t-10" readonly/>
                </div>
                <div class="modal-footer">
                    <form class="form-horizontal" method="post" action="{{ route('subs.destroy', 'del') }}">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="id" id="id" class="form-control" readonly/>
                        <input type="submit" class="btn btn-danger waves-effect" value="HAPUS DATA"/>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">BATALKAN PENGHAPUSAN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Modal Penghapusan Data Sub-Aktivitas -->
@endsection
