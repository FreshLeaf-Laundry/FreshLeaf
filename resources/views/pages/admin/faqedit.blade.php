@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Pengaturan FAQ</h1>
    
    <!-- Create FAQ -->
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFaqModal">
            Tambah FAQ Baru
        </button>
    </div>

    <!-- FAQ List -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            FAQ List
        </div>
        <div class="card-body">
            <table id="faqTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th width="50px">Urutan</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th width="200px">Hapus</th>
                    </tr>
                </thead>
                <tbody id="faq-items">
                    @foreach($faqs as $faq)
                    <tr data-id="{{ $faq->id }}" data-order="{{ $faq->order }}">
                        <td class="drag-handle"><i class="fas fa-grip-vertical"></i></td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                            <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
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

<!-- Add FAQ Modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="addFaqForm" action="{{ route('admin.faq.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control" id="question" name="question" required>
                    </div>
                    <div class="mb-3">
                        <label for="answer" class="form-label">Answer</label>
                        <textarea class="form-control" id="answer" name="answer" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Handle flash messages immediately
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: "{{ session('error') }}",
        });
    @endif

    document.addEventListener('DOMContentLoaded', function() {
        // Delete confirmation
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit();
                    }
                });
            });
        });
    });
</script>
@endpush

@push('styles')
<style>
    .drag-handle {
        cursor: move;
        padding: 5px;
    }
    .dragging {
        opacity: 0.5;
        background: #f8f9fa;
    }
    .btn.btn-primary {
        background-color: var(--hijau-tua-primary);
        color: var(--krem-primary);
        border: none;
    }
    .btn.btn-primary:hover {
        background-color: var(--krem-primary);
        color: var(--hijau-tua-primary);
        border: 1px solid var(--hijau-tua-primary);
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.14.0/Sortable.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var el = document.getElementById('faq-items');
        var sortable = new Sortable(el, {
            animation: 150,
            handle: '.drag-handle',
            ghostClass: 'dragging',
            onEnd: function(evt) {
                let items = Array.from(el.getElementsByTagName('tr')).map((tr, index) => {
                    return {
                        id: tr.dataset.id,
                        order: index
                    };
                });

                // Send the new order to the server
                fetch('{{ route("admin.faq.reorder") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ items: items })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Optional: show success message
                        console.log('Order updated successfully');
                    }
                })
                .catch(error => {
                    console.error('Error updating order:', error);
                });
            }
        });
    });
</script>
@endpush
