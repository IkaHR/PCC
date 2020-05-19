@extends('layouts.header')

@section('content')

    <aside id="leftsidebar" class="sidebar">
        <div class="card profile-card">
            <div class="profile-header">&nbsp;</div>
            <div class="profile-body">
                <div class="image-area">
                    <img src="{{ asset('images/user-lg.jpg') }}" alt="Profile Image" />
                </div>
                <div class="content-area">
                    <h3>{{ Auth::user()->name }}</h3>
                    <p>{{ Auth::user()->email }}</p>
                    <p>Akuntan</p>
                </div>
            </div>
            <div class="profile-footer">
                <ul>
                    <li>
                        <span>Badan Usaha ditangani</span>
                        <span>1.234</span>
                    </li>
                    <li>
                        <span>Produk dihitung</span>
                        <span>1.201</span>
                    </li>
                </ul>
                <a class="btn btn-block btn-lg btn-success waves-effect" href="#">
                <i class="material-icons">settings</i>
                <span>Setting</span>
                </a>
                <a class="btn btn-block btn-lg btn-danger waves-effect"
                    href="{{ route('logout') }}" 
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="material-icons">input</i>
                    <span>{{ __('Logout') }}</span>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
                            

            </div>
        </div>
    </aside>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading">BADAN USAHA</h4> 
                        <small>Daftar Badan Usaha yang Ditangani. </small>
                    </div>
                    <div class="media-right">
                        <a href="#" class="btn btn-block btn-lg btn-success waves-effect">
                            <i class="material-icons">add_box</i>
                            <span>TAMBAH BADAN USAHA</span>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">

            <!-- List badan usaha -->
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="card">
                    <a href="#">
                    <div class="body bg-green">
                        <h2>
                            Nama Badan Usaha
                        </h2>
                        <hr>
                        Quis pharetra a pharetra fames blandit. Risus faucibus velit Risus imperdiet mattis neque volutpat, etiam lacinia netus dictum magnis per facilisi sociosqu. Volutpat. Ridiculus nostra.
                    </div>
                    </a>
                </div>
            </div>

                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12"> 
                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                                Nama Badan Usaha <small>Keterangan singkat disini...</small>
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Profil Usaha</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Daftar Produk</a></li>
                                        <li><a href="javascript:void(0);" class=" waves-effect waves-block">Pengaturan Lanjut</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div id="carousel-example-generic" class="carousel slide">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <img src="{{ asset('images/image-gallery/11.jpg') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- Akhir list badan usaha -->

            </div>  
        </div>
    </section>

@endsection