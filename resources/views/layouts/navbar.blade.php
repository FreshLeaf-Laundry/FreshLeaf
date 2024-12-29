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
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a>
                </li>
                @auth
                @if(Auth::user()->is_admin != 1)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('voucher') ? 'active' : '' }}" href="{{ route('voucher') }}">Voucher</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('feedback') ? 'active' : '' }}" href="{{ route('feedback') }}">Feedback</a>
                        </li>
                         <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('orders.create') ? 'active' : '' }}" href="{{ route('orders.create') }}">Order</a>
                        </li>
                    @endif
                @endauth
                @auth
                {{-- if it works, dont mess with it -gandhi probably --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                @endauth
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
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn logoutbutton px-3 py-1" href="#" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(Auth::user()->is_admin == 1)
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.usermgt') }}">
                                        <i class="bi bi-speedometer2"></i> Users Management
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('feedback') }}">
                                        <i class="bi bi-chat-dots"></i> Feedbacks
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.faq') }}">
                                        <i class="bi bi-question-circle"></i> FAQ Edit
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.vouchers') }}">
                                        <i class="bi bi-ticket-perforated"></i> Kelola Voucher
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('admin.orders.admin') }}">
                                        <i class="bi bi-ticket-perforated"></i> Kelola Order
                                    </a>
                                </li>
                            @endif
                            @auth
                                @unless(auth()->user()->is_admin)
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}" href="{{ route('profile.edit') }}">Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ request()->routeIs('orders.index') ? 'active' : '' }}" href="{{ route('orders.index') }}">Order</a>
                                    </li>
                                @endunless
                            @endauth
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
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
