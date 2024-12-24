<!-- resources/views/vouchers/create.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Voucher</h1>
        <form action="{{ route('vouchers.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="code" class="form-label">Kode Voucher</label>
                <input type="text" name="code" id="code" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="discount" class="form-label">Diskon (%)</label>
                <input type="number" name="discount" id="discount" class="form-control" required min="0" max="100">
            </div>
            <div class="mb-3">
                <label for="expiry_date" class="form-label">Tanggal Kadaluarsa</label>
                <input type="date" name="expiry_date" id="expiry_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
