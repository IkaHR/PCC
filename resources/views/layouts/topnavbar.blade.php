<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ asset('/home')}}">PCC - Production Cost Counter</a>
        </div>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- Notifications -->
                <li class="dropdown">
                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button">
                        <i class="material-icons">settings</i>
                    </a>
                    
                    <ul class="dropdown-menu">
                        <li class="header">PENGATURAN</li>
                        <li class="body">
                            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
                            <ul class="menu" style="overflow: hidden; width: auto; height: auto;">
                            @php ($segment = Request::segment(1))
                            @unless ($segment == 'home')
                                <li>
                                    <a href="javascript:void(0);" class=" waves-effect waves-block">
                                        <div class="icon-circle bg-light-green">
                                            <i class="material-icons">home</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>Kembali ke HOME</h4>
                                            <p>
                                                Kembali ke halaman Home
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @endunless
                                <li>
                                    <a href="javascript:void(0);" class=" waves-effect waves-block">
                                        <div class="icon-circle bg-cyan">
                                            <i class="material-icons">account_circle</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>Pengaturan Profil</h4>
                                            <p>
                                                Masuk ke pengaturan profil Akuntan
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class=" waves-effect waves-block"
                                        href="{{ route('logout') }}" 
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <div class="icon-circle bg-red">
                                            <i class="material-icons">input</i>
                                        </div>
                                        <div class="menu-info">
                                            <h4>{{ __('Logout') }}</h4>
                                            <p>
                                                Keluar dari akun
                                            </p>
                                        </div>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- #END# Notifications -->
            </ul>
        </div>

    </div>
</nav>