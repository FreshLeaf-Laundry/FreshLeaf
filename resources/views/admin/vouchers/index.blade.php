@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Voucher</h3>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form Tambah Voucher -->
                    <form action="{{ route('admin.vouchers.store') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="code" 
                                    class="form-control @error('code') is-invalid @enderror" 
                                    placeholder="Kode Voucher" required>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="discount" 
                                    class="form-control @error('discount') is-invalid @enderror" 
                                    placeholder="Diskon (%)" required>
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="expiry_date" 
                                    class="form-control @error('expiry_date') is-invalid @enderror" required>
                                @error('expiry_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Tambah Voucher</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Daftar Voucher -->
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Diskon</th>
                                    <th>Berlaku Sampai</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vouchers as $voucher)
                                <tr>
                                    <td>{{ $voucher->code }}</td>
                                    <td>{{ $voucher->discount }}%</td>
                                    <td>{{ $voucher->expiry_date->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge {{ $voucher->expiry_date->isFuture() ? 'bg-success' : 'bg-danger' }}">
                                            {{ $voucher->expiry_date->isFuture() ? 'Aktif' : 'Kadaluarsa' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.vouchers.delete', $voucher) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                onclick="return confirm('Yakin ingin menghapus voucher ini?')">
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
</style>
@endsection