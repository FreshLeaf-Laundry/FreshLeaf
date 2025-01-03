@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Checkout</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title mb-4">Detail Pesanan</h5>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset($item->item->image_path) }}" 
                                                 alt="{{ $item->item->name }}"
                                                 style="width: 50px; height: 50px; object-fit: cover;"
                                                 class="me-3">
                                            {{ $item->item->name }}
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($item->item->price, 0, ',', '.') }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>Rp {{ number_format($item->item->price * $item->quantity, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                    <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Pembayaran</h5>
                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select name="payment_method" class="form-select" required>
                                <option value="midtrans">Midtrans</option>
                                <option value="cod">Cash on Delivery</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Voucher</label>
                            <input type="text" 
                                   name="voucher" 
                                   class="form-control"
                                   placeholder="Masukkan kode voucher">
                            <small class="text-muted">
                                Voucher yang tersedia:
                                @foreach(App\Models\Voucher::where('expiry_date', '>', now())->get() as $voucher)
                                    <br>- {{ $voucher->code }} ({{ $voucher->discount }}% off)
                                @endforeach
                            </small>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="printInvoice" 
                                   name="print_invoice">
                            <label class="form-check-label" for="printInvoice">
                                Cetak Invoice
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Selesaikan Pesanan
                        </button>
                    </form>
                </div>
            </div>
        </div>
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
    .btn-primary {
        background-color: var(--hijau-tua-primary);
        color: var(--krem-primary);
        border: none;
    }
    .btn-primary:hover {
        background-color: var(--krem-primary);
        color: var(--hijau-tua-primary);
        border: 1px solid var(--hijau-tua-primary);
    }
</style>
@endpush
@endsection
