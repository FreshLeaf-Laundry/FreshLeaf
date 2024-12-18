<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto"> <!-- ul buat tombol navigasi -->
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
                </li>
            </ul>
            <ul class="navbar-nav"> <!-- ul buat tombol login/ register -->
                <li class="nav-item">
                    <a class="nav-link btn loginbutton" href="{{ route('home') }}">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn registerbutton" href="{{ route('home') }}">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<style>
    .navbar-brand{
        color:#347928;
    }
    .navbar-brand:hover{
        color:#FCCD2A;
    }
    .navbar{
        background-color: #FFFBE6;
        height: 15vh;
        padding-left: 20px; 
        padding-right: 20px; 
        font-size: 22px;
    }
    .navbar-nav .nav-link{
        transition: background-color 0.3s,
        color 0.3s;
        color: #d4d4d4
    }
    .navbar-nav .nav-link.active{
        /* background-color: #33aa20; */
        color: #347928;
        /* border-radius: 7px; */
        border-bottom: 2px solid #347928;
    }
    .navbar-nav .nav-link:hover{
        color: #347928;
    }
    .navbar-nav .nav-item .loginbutton{
        background-color: #347928;
        color: #FFFBE6;
        padding-left: 32px;
        padding-right: 32px;
        border: 2px solid #347928;
    }
    .navbar-nav .nav-item .loginbutton:hover{
        color: #347928;
        background-color: #FFFBE6;
    }
    .navbar-nav .nav-item .registerbutton{
        color: #347928;
        margin-left: 20px;
        padding-left: 32px;
        padding-right: 32px;
        border: 2px solid #347928;
    }
    .navbar-nav .nav-item .registerbutton:hover{
        background-color: #347928;
        color: #FFFBE6;
    }
</style>