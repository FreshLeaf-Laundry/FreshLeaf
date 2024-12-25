@extends('layouts.app')
{{-- test github --}}
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($feedbacks as $feedback)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $feedback->user->name }}</td>
                                <td>{{ $feedback->message }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Belum ada feedback.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
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
        @endif

    </div>
@endsection

@section('styles')
    <style>

    </style>
@endsection

@section('scripts')
    <script></script>
@endsection
