@extends('layouts.header')

@section('title', 'Home')

@section('content')

    @include('layouts.topnavbar')

    @include('layouts.homesidebar')

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
                        <h4 class="media-heading">BADAN USAHA</h4>
                        <small>Daftar Badan Usaha yang Ditangani. </small>
                    </div>
                    <div class="media-right">
                        <button onclick="window.location.href='{{ route('usahas.create') }}';" class="btn btn-block btn-lg btn-success waves-effect">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH BADAN USAHA</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
            <!-- TABEL DAFTAR BADAN USAHA -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Nama Badan Usaha</th>
                                            <th>Informasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Badan Usaha</th>
                                            <th>Informasi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($usaha as $u)
                                        <tr>
                                            <td>{{ $u->nama }}</td>
                                            <td>
                                                <ul class="list-group">
                                                    <li class="list-group-item"><b>No. Telp: </b>{{ $u->phone ?? '-'}}</li>
                                                    <li class="list-group-item"><b>Email: </b>{{ $u->email ?? '-'}}</li>
                                                    <li class="list-group-item"><b>Alamat: </b>{{ $u->alamat ?? '-'}}</li>
                                                    <li class="list-group-item"><b>Deskripsi: </b>{{ $u->deskripsi ?? '-'}}</li>
                                                </ul>
                                            </td>
                                            <td>
                                                <div class="list-group">
                                                    <button onclick="window.location.href='{{ route('dashboard') }}?u={{ $u->id }}';" class="list-group-item btn bg-cyan">
                                                        <i class="material-icons">dashboard</i>
                                                        <span>Buka Dashboard</span>
                                                    </button>
                                                </div>
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
            <!-- #END# TABEL DAFTAR BADAN USAHA -->

            <div class="row clearfix">
                <!-- TABEL DAFTAR BADAN USAHA -->
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body">
                            <div class="body">
                                <div class="demo-masked-input">
                                    <div class="row clearfix">
                                        <div class="col-md-3">
                                            <b>Date</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">date_range</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control date" placeholder="Ex: 30/07/2016">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Time (24 hour)</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">access_time</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control time24" placeholder="Ex: 23:59">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Time (12 hour)</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">access_time</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control time12" placeholder="Ex: 11:59 pm">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Date Time</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">date_range</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control datetime" placeholder="Ex: 30/07/2016 23:59">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Mobile Phone Number</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone_iphone</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control mobile-phone-number" placeholder="Ex: +00 (000) 000-00-00">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Phone Number</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">phone</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control mobile-phone-number" placeholder="Ex: +00 (000) 000-00-00">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Money (Dollar)</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">attach_money</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control money-dollar" placeholder="Ex: 99,99 $">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Money (Euro)</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">euro_symbol</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control money-euro" placeholder="Ex: 99,99 €">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>IP Address</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">computer</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control ip" placeholder="Ex: 255.255.255.255">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Credit Card</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">credit_card</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control credit-card" placeholder="Ex: 0000 0000 0000 0000">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Email Address</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">email</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control email" placeholder="Ex: example@example.com">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <b>Serial Key</b>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">vpn_key</i>
                                                </span>
                                                <div class="form-line">
                                                    <input type="text" class="form-control key" placeholder="Ex: XXX0-XXXX-XX00-0XXX">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection
