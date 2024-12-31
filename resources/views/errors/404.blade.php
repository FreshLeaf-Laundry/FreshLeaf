@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <img src="{{ asset('images/404.jpg') }}" alt="404 Not Found" class="img-fluid mb-4" style="max-width: 400px;">
            <h2 class="mb-3">Halaman Tidak Ditemukan</h2>
            <p class="mb-4">Maaf, halaman yang Anda cari tidak ditemukan.</p>
            <a href="{{ route('home') }}" class="btn btn-primary mb-5">
                <i class="bi bi-house-door"></i> Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@push('styles')
<style>
    .btn-primary {
        background-color: var(--hijau-tua-primary);
        border-color: var(--hijau-tua-primary);
    }
    .btn-primary:hover {
        background-color: var(--krem-primary);
        border-color: var(--hijau-tua-primary);
        color: var(--hijau-tua-primary);
    }
</style>
@endpush
@endsection