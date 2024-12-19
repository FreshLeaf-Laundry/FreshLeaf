@extends('layouts.nonavbar')

@section('title', 'Login')

@section('content')
<div class="container-fluid min-vh-100 p-0">

    <div class="row g-0 min-vh-100">
        {{-- Login Form Section --}}
        <div class="col-md-5 bg-white align-items-center position-relative shadow-lg flex-row">
            <div class="sticky-button p-md-5">
                <a href="{{ url('/') }}" class="btn btn-secondary rounded-circle" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5"/>
                    </svg>
                </a>
            </div>
            <div class="w-100 p-4 p-md-5">
                <div class="mb-4">
                    <h2 class="fw-bold mb-2">Welcome Back</h2>
                    <p class="text-muted">Please log in to your account</p>
                </div>

                <form method="POST" action="{{ route('login') }}" class="loginform">
                    @csrf

                    {{-- Email --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input 
                            type="text" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="email" 
                            name="email"
                            required
                        >
                    </div>

                    {{-- Password Field --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password"
                            required
                        >
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Remember Me --}}
                    <div class="mb-3 form-check">
                        <input 
                            type="checkbox" 
                            class="form-check-input" 
                            id="remember" 
                            name="remember"
                        >
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        Log In
                    </button>
                </form>
                <span class="text-muted">
                    Belum punya akun?? 
                    <a href="{{ route('register') }}">Daftar disini</a>
                </span>
            </div>
        </div>

        {{-- Background Image Section --}}
        <div class="col-md-7 d-none d-md-block" style="
            min-height: 100vh;
        "></div>
    </div>
</div>
@endsection
<style>
    .col-md-7{
        background: url("{{ asset('images/loginbg.jpg') }}") center/cover no-repeat;
    }
    .sticky-button .rounded-circle{
        background-color: #347928;
        border: none
    }
    .loginform .btn-primary{
        background-color: #347928; 
        color: white; 
        padding-left: 25px; 
        padding-right: 25px; 
        border: 2px solid #347928; 
        transition: background-color 0.3s;
    }
    .loginform .btn-primary:hover{
        color: #347928; 
        background-color: #FFFBE6; 
        border-color: #347928;
    }
</style>