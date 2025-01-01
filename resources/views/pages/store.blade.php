@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1 class="text-center mb-5">Our Products</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($items as $item)
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset($item->image_path) }}" 
                     class="card-img-top" 
                     alt="{{ $item->name }}"
                     style="height: 200px; object-fit: cover;">
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->name }}</h5>
                    <p class="card-text text-muted mb-1">{{ $item->category }}</p>
                    <p class="card-text">{{ $item->description }}</p>
                    <div class="mt-auto">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="h5 mb-0">Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                            <span class="badge bg-{{ $item->stock > 5 ? 'success' : 'warning' }}">
                                Stock: {{ $item->stock }}
                            </span>
                        </div>
                        @auth
                            <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <div class="input-group">
                                    <input type="number" 
                                           name="quantity" 
                                           value="1" 
                                           min="1" 
                                           max="{{ $item->stock }}" 
                                           class="form-control"
                                           style="max-width: 80px;">
                                    <button type="submit" class="btn btn-primary flex-grow-1">
                                        <i class="bi bi-cart-plus"></i> Tambahkan ke Keranjang
                                    </button>
                                </div>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100 mt-3">
                                Login to Purchase
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@push('scripts')
<script>
    // Show error message if exists
    @if(session('error'))
        Swal.fire({
            title: 'Error!',
            text: '{{ session('error') }}',
            icon: 'error',
            confirmButtonText: 'OK'
        });
    @endif

    // Show success message if exists
    @if(session('success'))
        Swal.fire({
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    @endif
</script>
@endpush

@push('styles')
<style>
    .card {
        transition: transform 0.2s;
        border: none;
        background-color: var(--krem-primary);
    }
    
    .card:hover {
        transform: translateY(-5px);
    }

    .btn-primary {
        background-color: var(--hijau-tua-primary);
        border: none;
    }

    .btn-primary:hover {
        background-color: var(--kuning-secondary);
    }

    .btn-outline-primary {
        color: var(--hijau-tua-primary);
        border-color: var(--hijau-tua-primary);
    }

    .btn-outline-primary:hover {
        background-color: var(--hijau-tua-primary);
        color: var(--krem-primary);
    }
</style>
@endpush
@endsection
