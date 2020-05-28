<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info" style="background:green; color:white">
            <div>
                <h2>{{ $datausaha->nama ?? '-'}}</h2>
                <h6>Email: {{ $datausaha->email ?? '-'}}</h6>
                <h6>No. Telp: {{ $datausaha->phone ?? '-'}}</h6>
            </div>
            <div class="btn-group user-helper-dropdown" style="position:absolute; right:10px; bottom:12px; background:green; box-shadow:none; cursor:pointer;">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="javascript:void(0);"><i class="material-icons">work</i>Profil Usaha</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ asset('/home')}}"><i class="material-icons">home</i>Dashboard</a></li>
                    </ul>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN MENU</li>
                <li class="">
                    <a href="#">
                        <i class="material-icons">layers</i>
                        <span>Produk/Layanan</span>
                    </a>
                </li>
                <li class="">
                    <a href="#">
                        <i class="material-icons">data_usage</i>
                        <span>Aktivitas Produksi</span>
                    </a>
                </li>
                <li class="">
                    <a href="#">
                        <i class="material-icons">donut_small</i>
                        <span>Resources</span>
                    </a>
                </li>
                <li class="">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">monetization_on</i>
                        <span>Biaya</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="">
                            <a href="javascript:void(0);">Per Aktivitas</a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0);">Per Produk</a>
                        </li class="">
                        <li>
                            <a href="javascript:void(0);">Biaya Langsung</a>
                        </li>
                    </ul>
                </li>
                <li class="header">Pengaturan</li>
                <li class="{{ $profil ?? '#'}}">
                    <a href="#">
                        <i class="material-icons">work</i>
                        <span>Profil Usaha</span>
                    </a>
                </li>
                <li>
                    <a href="{{ asset('/home')}}">
                        <i class="material-icons">home</i>
                        <span>Kembali ke Dashboard</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2020 <a href="javascript:void(0);">{{ config('app.name', 'Laravel') }}</a>.
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>
