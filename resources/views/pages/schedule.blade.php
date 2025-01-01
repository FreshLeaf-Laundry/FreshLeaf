@extends('layouts.app')

@section('title', 'Schedule')

@section('content')
<div class="container mt-4">
    <h1>Jadwal Delivery Laundry</h1>
    
    <div class="row mt-4">
        @foreach($schedule as $schedule)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-text">Pesanan: {{ $schedule->order_id }}</h5>
                    <p class="card-text">Tanggal Pengambilan: {{ \Carbon\Carbon::parse($schedule->pickup_date)->format('d/m/Y') }}</p>
                    <p class="card-text">Tanggal Pengantaran: {{ \Carbon\Carbon::parse($schedule->delivery_date)->format('d/m/Y') }}</p>
                    <p class="card-text">Status: 
                        <span class="badge {{ $schedule->status === 'diambil' ? 'bg-primary' : 
                                            ($schedule->status === 'diproses' ? 'bg-warning' : 
                                            ($schedule->status === 'diantar' ? 'bg-info' : 
                                            ($schedule->status === 'selesai' ? 'bg-success' : ''))) }}">
                            {{ $schedule->status }}
                        </span>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    .badge {
        padding: 8px 12px;
        border-radius: 4px;
        font-size: 0.9em;
        text-transform: capitalize;
    }
</style>
@endsection

@section('scripts')
<script>
    // Custom scripts can be added here
</script>
@endsection
