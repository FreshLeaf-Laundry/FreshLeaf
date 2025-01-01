@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Jadwal Delivery</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form Tambah Jadwal -->
                    <form action="{{ route('admin.schedule.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row">
                            <div class="col-md-2">
                                <select name="order_id" id="order_id" class="form-control @error('order_id') is-invalid @enderror" required>
                                    <option value="">Pilih Order</option>
                                    @foreach(\App\Models\Order::orderBy('id', 'asc')->get() as $order)
                                        <option value="{{ $order->id }}" data-pickup="{{ $order->pickup_date }}">Order #{{ $order->id }}</option>
                                    @endforeach
                                </select>
                                @error('order_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <script>
                                document.getElementById('order_id').addEventListener('change', function() {
                                    var selectedOption = this.options[this.selectedIndex];
                                    var pickupDate = selectedOption.getAttribute('data-pickup');
                                    document.getElementById('pickup_date').value = pickupDate;
                                });
                            </script>
                            <div class="col-md-2">
                                <input type="text" name="pickup_date" id="pickup_date" class="form-control" readonly>
                                @error('pickup_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <input type="date" name="delivery_date" 
                                    class="form-control @error('delivery_date') is-invalid @enderror" 
                                    placeholder="Tanggal Pengantaran" required>
                                @error('delivery_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                                    <option value="">Pilih Status</option>
                                    <option value="diambil" {{ old('status') == 'diambil' ? 'selected' : '' }}>Diambil</option>
                                    <option value="diproses" {{ old('status') == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                    <option value="diantar" {{ old('status') == 'diantar' ? 'selected' : '' }}>Diantar</option>
                                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Daftar Jadwal -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Pesanan</th>
                                    <th>Tanggal Pengambilan</th>
                                    <th>Tanggal Pengantaran</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($schedule->sortBy('id') as $schedule)
                                <tr>
                                    <td>{{ $schedule->id }}</td>
                                    <td>{{ $schedule->order_id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->pickup_date)->format('d/m/Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->delivery_date)->format('d/m/Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.schedule.update', $schedule->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-control status-select" onchange="this.form.submit()">
                                                <option value="diambil" {{ $schedule->status == 'diambil' ? 'selected' : '' }}>Diambil</option>
                                                <option value="diproses" {{ $schedule->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                <option value="diantar" {{ $schedule->status == 'diantar' ? 'selected' : '' }}>Diantar</option>
                                                <option value="selesai" {{ $schedule->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.schedule.delete', $schedule) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Yakin ingin menghapus jadwal ini?')">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        margin-top: 20px;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .card-header {
        background-color: var(--hijau-tua-primary);
        color: white;
    }
    
    .btn-primary {
        background-color: var(--hijau-tua-primary);
        border-color: var(--hijau-tua-primary);
    }
    
    .btn-primary:hover {
        background-color: var(--kuning-secondary);
        border-color: var(--kuning-secondary);
        color: var(--hijau-tua-primary);
    }

    .status-select {
        padding: 5px;
        border-radius: 4px;
    }

    .status-select:has(option[value="diambil"]:checked) {
        background-color: #007bff;
        color: white;
    }

    .status-select:has(option[value="diproses"]:checked) {
        background-color: #ffc107;
        color: black;
    }

    .status-select:has(option[value="diantar"]:checked) {
        background-color: #17a2b8;
        color: black;
    }

    .status-select:has(option[value="selesai"]:checked) {
        background-color: #28a745;
        color: white;
    }
</style>
@endsection