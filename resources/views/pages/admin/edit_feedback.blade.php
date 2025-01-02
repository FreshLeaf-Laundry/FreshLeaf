@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Feedback</h2>

    <form action="{{ route('feedback.update', $feedback->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="message">Pesan Feedback</label>
            <textarea name="message" id="message" class="form-control" rows="4" required>{{ old('message', $feedback->message) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
        <a href="{{ route('feedback') }}" class="btn btn-secondary mt-3">Batal</a>
    </form>
</div>
@endsection
