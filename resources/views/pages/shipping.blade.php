@extends('layouts.app')

@section('title', 'Daftar Pesanan')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Daftar Pesanan Anda</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($orders->isEmpty())
        <div class="alert alert-info text-center">
            Anda belum memiliki pesanan.
        </div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tanggal Pesanan</th>
                    <th>Tanggal Pengambilan</th>
                    <th>Berat (kg)</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->pickup_date ?? '-' }}</td>
                        <td>{{ $order->kg }} kg</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>{{ $order->status }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
