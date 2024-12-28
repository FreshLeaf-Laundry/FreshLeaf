@extends('layouts.app')

@section('title', 'Voucher')

@section('content')
<div class="container mt-4">
    <h1>Daftar Voucher</h1>
    
    <div class="row mt-4">
        @foreach($vouchers as $voucher)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $voucher->code }}</h5>
                    <p class="card-text">Diskon: {{ $voucher->discount }}%</p>
                    <p class="card-text">Berlaku sampai: {{ $voucher->expiry_date }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Custom styles can be added here */
</style>
@endsection

@section('scripts')
<script>
    // Custom scripts can be added here
</script>
@endsection
