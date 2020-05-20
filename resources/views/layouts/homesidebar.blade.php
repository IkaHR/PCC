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
                <span>Pengaturan Profil</span>
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