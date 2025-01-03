@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Kelola Voucher</h3>
                    <a href="{{ route('admin.vouchers.export') }}" class="btn btn-success">
                        <i class="bi bi-file-earmark-excel"></i> Export Data
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Form Tambah/Edit Voucher -->
                    <form action="{{ isset($voucher) ? route('admin.vouchers.update', $voucher) : route('admin.vouchers.store') }}" 
                          method="POST" class="mb-4">
                        @csrf
                        @if(isset($voucher))
                            @method('PUT')
                        @endif
                        <div class="row">
                            <div class="col-md-4">
                                <input type="text" name="code" 
                                    class="form-control @error('code') is-invalid @enderror" 
                                    placeholder="Kode Voucher"
                                    value="{{ isset($voucher) ? $voucher->code : old('code') }}" 
                                    required>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="discount" 
                                    class="form-control @error('discount') is-invalid @enderror" 
                                    placeholder="Diskon (%)"
                                    value="{{ isset($voucher) ? $voucher->discount : old('discount') }}" 
                                    required>
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="expiry_date" 
                                    class="form-control @error('expiry_date') is-invalid @enderror"
                                    value="{{ isset($voucher) ? $voucher->expiry_date->format('Y-m-d') : old('expiry_date') }}" 
                                    required>
                                @error('expiry_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($voucher) ? 'Update Voucher' : 'Tambah Voucher' }}
                                </button>
                                @if(isset($voucher))
                                    <a href="{{ route('admin.vouchers') }}" class="btn btn-secondary">Batal</a>
                                @endif
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
                                @foreach($vouchers as $v)
                                <tr>
                                    <td>{{ $v->code }}</td>
                                    <td>{{ $v->discount }}%</td>
                                    <td>{{ $v->expiry_date->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="badge {{ $v->expiry_date->isFuture() ? 'bg-success' : 'bg-danger' }}">
                                            {{ $v->expiry_date->isFuture() ? 'Aktif' : 'Kadaluarsa' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.vouchers.edit', $v) }}" 
                                           class="btn btn-info btn-sm">Edit</a>
                                        <form action="{{ route('admin.vouchers.delete', $v) }}" 
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
    
    .btn-success {
        background-color: var(--hijau-tua-primary);
        border-color: var(--hijau-tua-primary);
    }
    
    .btn-success:hover {
        background-color: var(--kuning-secondary);
        border-color: var(--kuning-secondary);
        color: var(--hijau-tua-primary);
    }
    
    .btn-info {
        background-color: var(--kuning-secondary);
        border-color: var(--kuning-secondary);
        color: var(--hijau-tua-primary);
    }
    
    .btn-info:hover {
        background-color: var(--hijau-tua-primary);
        border-color: var(--hijau-tua-primary);
        color: white;
    }
</style>
@endsection 