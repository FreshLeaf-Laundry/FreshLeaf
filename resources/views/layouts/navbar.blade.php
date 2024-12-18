<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<style>
    .navbar{
        background-color: white;
    }
    .navbar-nav .nav-link{
        transition: background-color 0.3s,
        color 0.3s;
        color: #d4d4d4
    }
    .navbar-nav .nav-link.active{
        /* background-color: #33aa20; */
        color: rgb(0, 0, 0);
        /* border-radius: 7px; */
        border-bottom: 2px solid #3ec728;
    }
    .navbar-nav .nav-link:hover{
        color: #3ec728;
    }
</style>