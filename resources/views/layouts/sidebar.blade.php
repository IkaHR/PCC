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
                    <li><a href="{{ asset('/home')}}"><i class="material-icons">home</i>Home</a></li>
                </ul>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            @php ($segment = Request::segment(1))
            <ul class="list">
                <li class="header">MAIN MENU</li>
                <li class="@if($segment =='dashboard') active @endif">
                    <a href="{{ route('dashboard') }}">
                        <i class="material-icons">dashboard</i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="@if($segment =='produks') active @endif">
                    <a href="{{ route('produks.index') }}">
                        <i class="material-icons">layers</i>
                        <span>Produk/Layanan</span>
                    </a>
                </li>
                <li class="@if($segment =='resources') active @endif">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">donut_small</i>
                        <span>Resources</span>
                    </a>
                    <ul class="ml-menu">
                        <li class="@if($segment =='resources') active @endif">
                            <a href="{{ asset('/resources') }}">Jangka Panjang <small>> 1 thn</small></a>
                        </li>
                        <li class="">
                            <a href="javascript:void(0);">Jangka Pendek <small>< 1 thn</small></a>
                        </li>
                    </ul>
                </li>
                <li class="@if($segment =='acts' || $segment == 'subs') active @endif">
                    <a href="{{ asset('/acts')}}">
                        <i class="material-icons">data_usage</i>
                        <span>Aktivitas Produksi</span>
                    </a>
                </li>
                <li class="@if($segment =='direct-exps') active @endif">
                    <a href="{{ asset('/direct-exps') }}">
                        <i class="material-icons">monetization_on</i>
                        <span>Pengeluaran Langsung</span>
                    </a>
                </li>
                <li class="header">Pengaturan</li>
                <li class="@if($segment =='usahas') active @endif">
                    <a href="{{ route('usahas.edit', $datausaha->id) }}">
                        <i class="material-icons">work</i>
                        <span>Profil Usaha</span>
                    </a>
                </li>
                <li>
                    <a href="{{ asset('/home')}}">
                        <i class="material-icons">home</i>
                        <span>Kembali ke Home</span>
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
