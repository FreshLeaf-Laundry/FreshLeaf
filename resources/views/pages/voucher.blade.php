@extends('layouts.app')

@section('title', 'Voucher')

@section('content')
<div class="container mt-4">
    <h1>Daftar Voucher</h1>
    <a href="{{ route('vouchers.create') }}" class="btn btn-primary mb-3">Tambah Voucher</a>

    @if ($vouchers->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Diskon (%)</th>
                    <th>Tanggal Kadaluarsa</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vouchers as $voucher)
                    <tr>
                        <td>{{ $voucher->code }}</td>
                        <td>{{ $voucher->discount }}</td>
                        <td>{{ $voucher->expiry_date }}</td>
                        <td>
                            <a href="{{ route('vouchers.edit', $voucher) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('vouchers.destroy', $voucher) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada voucher.</p>
    @endif
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
