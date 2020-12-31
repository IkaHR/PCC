@extends('layouts.header')

@section('title', 'Dashboard')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.sidebar')

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h4 class="media-heading"><b>DASHBOARD</b></h4>
            </div>
            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-indigo hover-zoom-effect" style="cursor:pointer;" onclick="window.location.href='{{ route('produks.index') }}';">
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
                    <div class="info-box bg-teal hover-zoom-effect" style="cursor:pointer;" onclick="window.location.href='{{ route('resources.index') }}';">
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
                    <div class="info-box bg-green hover-zoom-effect" style="cursor:pointer;" onclick="window.location.href='{{ route('acts.index') }}';">
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
                    <div class="info-box bg-light-green hover-zoom-effect" style="cursor:pointer;" onclick="window.location.href='{{ route('direct-exps.index') }}';">
                        <div class="icon">
                            <i class="material-icons">monetization_on</i>
                        </div>
                        <div class="content">
                            <div class="text">P. LANGSUNG</div>
                            <div class="number count-to" data-from="0" data-to="{{ $datausaha->direct_exps->count() }}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>DOKUMEN PDF</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>File PDF</th>
                                        <th>Detail</th>
                                        <th>Download</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Form Analisis</td>
                                        <td>Form untuk menganalisa aktivitas dan sub-aktivitas dalam usaha menggunakan standart MOST</td>
                                        <td>
                                            <a href="/download/MOST Form.pdf"
                                                    class="btn btn-info waves-effect" type="button">
                                                <i class="material-icons">download</i>
                                                <span>Download PDF</span>
                                            </a>&nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>General Move</td>
                                        <td>Panduan pengindeksan sub-aktivitas pada model urutan Geneeral Activity</td>
                                        <td>
                                            <a href="/download/General Move - Basic & Admin MOST.pdf"
                                                    class="btn bg-pink waves-effect" type="button">
                                                <i class="material-icons">download</i>
                                                <span>Download PDF</span>
                                            </a>&nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Controlled Move</td>
                                        <td>Panduan pengindeksan sub-aktivitas pada model urutan Controlled Activity</td>
                                        <td>
                                            <a href="/download/Controlled Move - Basic & Admin MOST.pdf"
                                                    class="btn bg-deep-purple waves-effect" type="button">
                                                <i class="material-icons">download</i>
                                                <span>Download PDF</span>
                                            </a>&nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Tool Use I</td>
                                        <td>Panduan pengindeksan sub-aktivitas dengan penggunaan alat bagian 1</td>
                                        <td>
                                            <a href="/download/Tool Use I - Basic MOST.pdf"
                                                    class="btn bg-teal waves-effect" type="button">
                                                <i class="material-icons">download</i>
                                                <span>Download PDF</span>
                                            </a>&nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Tool Use II</td>
                                        <td>Panduan pengindeksan sub-aktivitas dengan penggunaan alat bagian 2</td>
                                        <td>
                                            <a href="/download/Tool Use II - Basic MOST.pdf"
                                                    class="btn bg-deep-orange waves-effect" type="button">
                                                <i class="material-icons">download</i>
                                                <span>Download PDF</span>
                                            </a>&nbsp;
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Admin MOST</td>
                                        <td>Panduan pengindeksan sub-aktivitas dalam kegiatan administrasi</td>
                                        <td>
                                            <a href="/download/Admin MOST.pdf"
                                                    class="btn bg-yellow waves-effect" type="button">
                                                <i class="material-icons">download</i>
                                                <span>Download PDF</span>
                                            </a>&nbsp;
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
            </div>
        </div>
    </section>
@endsection
