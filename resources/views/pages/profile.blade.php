@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="text-center mb-4">
                <div class="avatar-wrapper">
                    <div class="profile-avatar">
                        <i class="bi bi-person-circle"></i>
                    </div>
                </div>
                <h3 class="mt-3">{{ Auth::user()->name }}</h3>
                <p class="text-muted">Member since {{ Auth::user()->created_at->format('F Y') }}</p>
            </div>

            <div class="card shadow fade-in">
                <div class="card-header bg-white">
                    <h4 class="mb-0">Profile Settings</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ Auth::user()->name }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ Auth::user()->email }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                id="current_password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" 
                                id="new_password" name="new_password">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" 
                                id="new_password_confirmation" name="new_password_confirmation">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .form-label {
        font-weight: 500;
        color: #2c3e50;
    }
    
    .btn-primary {
        background-color: var(--krem-primary);
        color: #2B8761;
        border: none;
    }
    
    .btn-primary:hover {
        background-color: #2B8761;
        color: var(--krem-primary);
    }
    
    .card {
        border: none;
        border-radius: 15px;
    }
    
    .card-header {
        border-bottom: 1px solid #eee;
        padding: 1.5rem;
        border-radius: 15px 15px 0 0 !important;
    }
    
    .card-body {
        padding: 2rem;
    }

    .avatar-wrapper {
        display: inline-block;
        margin-bottom: 1rem;
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background-color: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid var(--krem-primary);
    }

    .profile-avatar i {
        font-size: 60px;
        color: #6c757d;
    }
</style>
@endsection
