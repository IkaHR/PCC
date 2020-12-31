@extends('layouts.header')

@section('title', 'Produk/Layanan')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">

            @include('layouts.notification')

            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">PRODUK & LAYANAN</h4>
                        <small>Daftar Produk dan Layanan yang dimiliki oleh {{ $datausaha -> nama }}</small>
                    </div>
                    <div class="media-right">
                        <button onclick="window.location.href='{{ route('produks.create') }}';" class="btn btn-block btn-lg btn-success waves-effect">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH PRODUK/LAYANAN</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
            <!-- TABEL DAFTAR PRODUK/LAYANAN -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Laporan Biaya</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jenis</th>
                                            <th>Laporan Biaya</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>

                                    @foreach($produk as $p)
                                        <tr>
                                            <td>{{ $p->nama }}</td>
                                            <td>{{ $p->jenis==1 ? 'Produk' : 'Layanan' }}</td>
                                            <td>
                                                @if(!$p->acts->isEmpty())
                                                <button onclick="window.open('{{ route('produks.laporan', $p->id) }}')"
                                                        class="btn btn-info waves-effect" type="button">
                                                    <i class="material-icons">assignment</i>
                                                    <span>Download Laporan</span>
                                                </button>&nbsp;
                                                @endif
                                            </td>
                                            <td>
                                                <b>{{ $p->acts->count() }}</b>
                                                <span style="color: #f65d20">Aktivitas Produksi</span> |
                                                <b>{{ $p->directs->count() }}</b>
                                                <span style="color: #f65d20">Pengeluaran Langsung</span>
                                                <br />
                                                @if($p->deskripsi != null)
                                                    <button type="button" class="btn btn-default waves-effect m-t-10"
                                                            data-trigger="focus" data-container="body" data-toggle="popover"
                                                            data-placement="bottom" title="{{ $p->nama }}"
                                                            data-content="{{ $p->deskripsi ?? '(Tidak ada catatan)' }}">
                                                        {{ \Illuminate\Support\Str::limit($p->deskripsi, 45, $end='...') }}
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                <button onclick="window.location.href='{{ route('produks.edit', $p->id) }}';"
                                                        class="btn bg-teal waves-effect m-b-10 m-l-5" type="button"
                                                        data-toggle="tooltip" data-placement="bottom" title="Aktivitas Produksi">
                                                    <i class="material-icons">data_usage</i>
                                                </button>
                                                <button onclick="window.location.href='{{ route('produks.edit', $p->id).'#direct-exps' }}';"
                                                        class="btn bg-light-green waves-effect m-b-10 m-l-5" type="button"
                                                        data-toggle="tooltip" data-placement="bottom" title="Pengeluaran Langsung">
                                                    <i class="material-icons">monetization_on</i>
                                                </button>
                                                <button onclick="window.location.href='{{ route('produks.edit', $p->id).'#setting' }}';"
                                                        class="btn btn-warning waves-effect m-b-10 m-l-5" type="button"
                                                        data-toggle="tooltip" data-placement="bottom" title="Pengaturan {{ $p->nama }}">
                                                    <i class="material-icons">settings</i>
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
            </div>
            <!-- #END# TABEL DAFTAR PRODUK/LAYANAN -->
        </div>
    </section>
@endsection
