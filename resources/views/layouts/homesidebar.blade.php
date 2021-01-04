<aside id="leftsidebar" class="sidebar">
    <div class="card profile-card">
        <div class="profile-header">&nbsp;</div>
        <div class="profile-body">
            <div class="image-area">
                <img src="/images/users/{{ Auth::user()->avatar }}" alt="Profile Image" style="height: 150px; background: white;"/>
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
                    <span>{{ $usaha->count() }}</span>
                </li>
            </ul>
            <hr>
            @php ($segment = Request::segment(1))
            @if($segment == 'profiles')
                <button onclick="window.location.href='{{ asset('/home') }}';"
                        class="btn btn-block btn-lg btn-success waves-effect">
                    <i class="material-icons">home</i>
                    <span>Kembali ke HOME</span>
                </button>
            @else
                <button onclick="window.location.href='{{ asset('/profiles') }}';"
                        class="btn btn-block btn-lg btn-success waves-effect">
                    <i class="material-icons">settings</i>
                    <span>Pengaturan Profil</span>
                </button>
            @endif
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
