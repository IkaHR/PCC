@extends('layouts.header')

@section('title', 'Produk/Layanan')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @include('layouts.notification')
                </div>
                <!-- TABEL DAFTAR AKTIVITAS -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <div class="media-body">
                                <h4 class="media-heading">DAFTAR AKTIVITAS</h4>
                                <small>Daftar aktivitas yang berhubungan dengan {{ $produk->nama }}</small>
                            </div>
                            <div class="media-right">
                                <button onclick="window.location.href='{{ route('act-pro.create') }}';"
                                        class="btn btn-block btn-lg btn-warning waves-effect">
                                    <i class="material-icons">add_box</i>
                                    <span>PILIH AKTIVITAS</span>
                                </button>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Aktivitas</th>
                                        <th>Frekuensi Pengulangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Aktivitas</th>
                                        <th>Frekuensi Pengulangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($produk->acts as $a)
                                        <tr>
                                            <td>{{ $a->nama }}</td>
                                            <td>{{ $a->pivot->frekuensi }}</td>
                                            <td>
                                                <form class="form-horizontal"  method="post" action="{{ route('act-pro.destroy', 'detach') }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="act_id" value="{{ $a -> id }}"/>
                                                    <input type="hidden" name="produk_id" value="{{ $produk -> id }}"/>
                                                    <input type="submit" class="btn btn-warning waves-effect" value="Hapus dari Produksi">&nbsp;
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
                <!-- #END# TABEL DAFTAR AKTIVITAS -->

                <!-- TABEL DAFTAR PENGELUARAN LANGSUNG -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="direct-exps">
                    <div class="card">
                        <div class="header">
                            <div class="media-body">
                                <h4 class="media-heading">DAFTAR PENGELUARAN LANGSUNG</h4>
                                <small>Daftar pengeluaran langsung yang berhubungan dengan {{ $produk->nama }}</small>
                            </div>
                            <div class="media-right">
                                <button onclick="window.location.href='{{ route('direct-pro.create') }}';"
                                        class="btn btn-block btn-lg btn-warning waves-effect">
                                    <i class="material-icons">add_box</i>
                                    <span>PILIH PENGELUARAN LANGSUNG</span>
                                </button>
                            </div>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Qt Dipakai</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Qt Dipakai</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($produk->directs as $d)
                                        <tr>
                                            <td>{{ $d->nama }}</td>
                                            <td>{{ $d->pivot->kuantitas }}</td>
                                            <td>
                                                <form class="form-horizontal"  method="post" action="{{ route('direct-pro.destroy', 'detach') }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" name="act_id" value="{{ $d -> id }}"/>
                                                    <input type="hidden" name="produk_id" value="{{ $produk -> id }}"/>
                                                    <input type="submit" class="btn btn-warning waves-effect" value="Hapus dari Produksi">&nbsp;
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
                <!-- #END# TABEL DAFTAR PENGELUARAN LANGSUNG -->

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT Produk/Layanan
                            </h2>
                        </div>
                        <div class="body">
                            <form class="form-horizontal"  method="post" action="{{ route('produks.update', $produk->id) }}" autocomplete="off">
                            @method('PUT')
                                @include('produks.form')
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <input type="submit" class="btn btn-primary waves-effect" value="Simpan Perubahan"/>&nbsp;
                                        <a href="{{ asset('/produks')}}" class="btn btn-danger waves-effect">BATAL</a>
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
                                HAPUS DATA PRODUK/LAYANAN
                            </h2>
                        </div>
                        <div class="body" id="setting">
                            <button type="button" class="btn bg-red waves-effect" data-toggle="modal" data-target="#defaultModal">HAPUS DATA PRODUK/LAYANAN</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Penghapusan Data Produk-->
    <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Hapus Semua Data {{ $produk->nama }} ?</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <b>Data Aktivitas</b> dan <b>Pengeluaran Langsung</b> yang berhubungan
                        dengan produk {{ $produk->nama }} <b>tidak akan</b> ikut terhapus.
                        Anda dapat menghapus data-data tersebut dengan mengaksesnya pada menu yang bersangkutan.
                    </p>
                </div>
                <div class="modal-footer">
                    <form class="form-horizontal" method="post" action="{{ route('produks.destroy', $produk->id) }}" autocomplete="on">
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
