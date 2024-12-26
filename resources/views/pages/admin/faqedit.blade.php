@extends('layouts.app')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage FAQs</h1>
    
    <!-- Add FAQ Button -->
    <div class="mb-4">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFaqModal">
            Add New FAQ
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
                        <th width="50px">Order</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th width="200px">Actions</th>
                    </tr>
                </thead>
                <tbody id="faq-items">
                    @foreach($faqs as $faq)
                    <tr data-id="{{ $faq->id }}" data-order="{{ $faq->order }}">
                        <td class="drag-handle"><i class="fas fa-grip-vertical"></i></td>
                        <td>{{ $faq->question }}</td>
                        <td>{{ $faq->answer }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary edit-faq" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editFaqModal"
                                    data-id="{{ $faq->id }}"
                                    data-question="{{ $faq->question }}"
                                    data-answer="{{ $faq->answer }}">
                                Edit
                            </button>
                            <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this FAQ?')">
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

<!-- Edit FAQ Modal -->
<div class="modal fade" id="editFaqModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit FAQ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="editFaqForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" id="edit_faq_id" name="faq_id">
                    <div class="mb-3">
                        <label for="edit_question" class="form-label">Question</label>
                        <input type="text" class="form-control" id="edit_question" name="question" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_answer" class="form-label">Answer</label>
                        <textarea class="form-control" id="edit_answer" name="answer" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#faqTable').DataTable();

        // Edit FAQ
        $('.edit-faq').click(function() {
            let id = $(this).data('id');
            let question = $(this).data('question');
            let answer = $(this).data('answer');
            
            $('#edit_faq_id').val(id);
            $('#edit_question').val(question);
            $('#edit_answer').val(answer);
            $('#editFaqForm').attr('action', `/admin/faq/${id}`);
        });

        // Delete FAQ
        $('.delete-faq').click(function() {
            let id = $(this).data('id');
            
            if (confirm('Are you sure you want to delete this FAQ?')) {
                $.ajax({
                    url: `/admin/faq/${id}`,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(error) {
                        alert('Error deleting FAQ');
                    }
                });
            }
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
