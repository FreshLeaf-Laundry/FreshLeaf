@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Keranjang Belanja</h1>

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

    @if($cartItems->isEmpty())
        <div class="alert alert-info">
            Keranjang belanja Anda kosong.
        </div>
    @else
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $cartItem)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($cartItem->item->image_path) }}" 
                                     alt="{{ $cartItem->item->name }}"
                                     style="width: 50px; height: 50px; object-fit: cover;"
                                     class="me-3">
                                {{ $cartItem->item->name }}
                            </div>
                        </td>
                        <td>Rp {{ number_format($cartItem->item->price, 0, ',', '.') }}</td>
                        <td>{{ $cartItem->quantity }}</td>
                        <td>Rp {{ number_format($cartItem->item->price * $cartItem->quantity, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td colspan="2">
                            <strong>
                                Rp {{ number_format($cartItems->sum(function($item) {
                                    return $item->item->price * $item->quantity;
                                }), 0, ',', '.') }}
                            </strong>
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('store') }}" class="btn btn-outline-primary">
                Continue Shopping
            </a>
            <button class="btn btn-primary">
                Proceed to Checkout
            </button>
        </div>
    @endif
</div>
@endsection
@push('styles')
<style>
    .btn.btn-primary {
        background-color: var(--hijau-tua-primary);
        color: var(--krem-primary);
        border: none;
    }
    .btn.btn-primary:hover {
        background-color: var(--krem-primary);
        color: var(--hijau-tua-primary);
        border: 1px solid var(--hijau-tua-primary);
    }
    .btn-outline-primary {
        background-color: var(--krem-primary);
        color: var(--hijau-tua-primary);
        border: 1px solid var(--hijau-tua-primary);
    }
    .btn-outline-primary:hover {
        background-color: var(--hijau-tua-primary);
        color: var(--krem-primary);
        border: 1px solid var(--krem-primary);
    }
</style>
@endpush
