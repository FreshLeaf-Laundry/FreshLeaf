<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto"> <!-- ul untuk tombol navigasi -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('voucher') ? 'active' : '' }}" href="{{ route('voucher') }}">Voucher</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('feedback') ? 'active' : '' }}" href="{{ route('feedback') }}">Feedback</a>
                </li>
                @endauth
                {{-- Jika sudah login dan role admin, tampilkan tombol admin dashboard --}}
                @if(auth()->check() && auth()->user()->is_admin == 1)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav"> <!-- ul untuk tombol login/register -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link btn loginbutton px-3 py-1" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn registerbutton px-3 py-1" href="{{ route('register') }}">Register</a>
                    </li>
                @endguest

                @auth
                    <li class="nav-item">
                        <a class="nav-link btn logoutbutton px-3 py-1" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>


<style>
    .navbar-brand {
        color: var(--hijau-tua-primary); 
    }
    .navbar-brand:hover {
        color: var(--kuning-secondary); 
    }
    .navbar {
        background-color: var(--krem-primary); 
        height: 15vh; 
        padding-left: 20px; 
        padding-right: 20px; 
        font-size: 22px; 
    }
    .navbar-nav .nav-link {
        transition: background-color 0.3s, color 0.3s; 
        color: #d4d4d4; 
    }
    .navbar-nav .nav-link.active {
        color: var(--hijau-tua-primary); 
        border-bottom: 2px solid var(--hijau-tua-primary); 
    }
    .navbar-nav .nav-link:hover {
        color: var(--hijau-tua-primary); 
    }
    .navbar-nav .nav-item .loginbutton {
        background-color: var(--hijau-tua-primary); 
        color: var(--krem-primary); 
        border: 2px solid var(--hijau-tua-primary); 
    }
    .navbar-nav .nav-item .loginbutton:hover {
        color: var(--hijau-tua-primary); 
        background-color: var(--krem-primary); 
    }
    .navbar-nav .nav-item .registerbutton {
        color: var(--hijau-tua-primary);
        margin-left: 20px; 
        border: 2px solid var(--hijau-tua-primary); 
    }
    .navbar-nav .nav-item .registerbutton:hover {
        background-color: var(--hijau-tua-primary); 
        color: var(--krem-primary); 
    }

    .navbar-expand-lg .container-fluid{
        background-color: var(--krem-primary); 
        border-radius: 7px;
        padding-bottom: 10px
    }
</style>
