@extends('layouts.app')

@section('title', 'Voucher')

@section('content')
    <div class="container mt-4">
        @if (auth()->check() && auth()->user()->is_admin)
            <div class="container mt-4">
                <h1>Semua Feedback</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Pesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $feedback->user->name }}</td>
                                <td>{{ $feedback->message }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-sm btn-warning">Edit</a>

                                    <!-- Tombol Delete -->
                                    <form action="{{ route('feedback.destroy', $feedback->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus feedback ini?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada feedback.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @elseif (auth()->check() && !auth()->user()->is_admin)
            <h1>Hi! {{ auth()->user()->name }}</h1>
            <h3>Berikan Feedback</h3>
            @if (session('success'))
                <div class="alert alert-success m-5">
                    {{ session('success') }}
                </div>
            @endif
            <form action="{{ route('feedback.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="message">Pesan Feedback</label>
                    <textarea name="message" id="message" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-3 mb-5">Kirim Feedback</button>
            </form>

            <div class="container mt-4">
                <h1>Semua Feedback</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Pesan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks2 as $feedback)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $feedback->user->name }}</td>
                                <td>{{ $feedback->message }}</td>
                                <td>
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('feedback.edit', $feedback->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada feedback.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@section('styles')
    <style>
        /* Tambahkan gaya khusus di sini */
    </style>
@endsection

@section('scripts')
    <script>
        // Tambahkan skrip khusus di sini
    </script>
@endsection
