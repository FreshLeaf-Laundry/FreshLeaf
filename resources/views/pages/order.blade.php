@extends('layouts.app')

@section('title', 'Fresh & Clean Laundry Services')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Buat Pesanan Laundry</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <form  method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kg" class="form-label">Jumlah Berat (kg)</label>
                            <input type="number" name="kg" id="kg" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="order_date" class="form-label">Tanggal Pesanan</label>
                            <input type="datetime-local" name="order_date" id="order_date" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="pickup_date" class="form-label">Tanggal Pengambilan (Opsional)</label>
                            <input type="datetime-local" name="pickup_date" id="pickup_date" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="total_price" class="form-label">Total Harga</label>
                            <input type="text" id="total_price" class="form-control" disabled>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Buat Pesanan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('kg').addEventListener('input', function () {
        var kg = parseFloat(this.value);
        var pricePerKg = 5000;
        if (!isNaN(kg)) {
            var totalPrice = kg * pricePerKg;
            document.getElementById('total_price').value = 'Rp ' + totalPrice.toLocaleString();
        } else {
            document.getElementById('total_price').value = '';
        }
    });
</script>
@endsection
