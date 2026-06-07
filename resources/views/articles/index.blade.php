@extends('layouts.adminlte4')

@section('title', 'Articles')

@section('active-menu-article', 'active')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i><strong>Success!</strong> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('status'))
<div class="alert alert-warning alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i><strong>Peringatan!</strong> {{ session('status') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="text-secondary fw-bold mb-0">Manage Articles</h4>
    <div>
        <button type="button" class="btn btn-warning rounded-pill px-4 shadow-sm me-2" data-bs-toggle="modal" data-bs-target="#btnFormModal">
            <i class="bi bi-plus-lg me-2"></i>New Article (with Modals)
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-secondary fw-semibold">Articles Table</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author (Doctor)</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $article)
                        <tr id="tr_{{ $article->id }}">
                            <td>{{ $article->id }}</td>
                            <td id="td_title_{{ $article->id }}">{{ $article->title }}</td>
                            <td id="td_doctor_{{ $article->id }}">{{ $article->doctor ? $article->doctor->name : '-' }}</td>
                            <td id="td_status_{{ $article->id }}">
                                @if($article->status == 'published')
                                    <span class="badge bg-success">Published</span>
                                @else
                                    <span class="badge bg-secondary">Draft</span>
                                @endif
                            </td>
                            <td id="td_views_{{ $article->id }}">{{ $article->views_count }}</td>
                            <td>
                                <a href="#modalEditA" class="btn btn-sm btn-warning rounded-pill px-3 me-1" data-bs-toggle="modal" onclick="getEditForm({{ $article->id }})">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit Type A
                                </a>

                                <a href="#modalEditB" class="btn btn-sm btn-primary rounded-pill px-3 me-1" data-bs-toggle="modal" onclick="getEditFormB({{ $article->id }})">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit Type B
                                </a>

                                <a href="#" class="btn btn-sm btn-danger rounded-pill px-3" onclick="if(confirm('Are you sure to delete this article?')) deleteDataRemove({{ $article->id }}); return false;">
                                    <i class="bi bi-trash-fill me-1"></i>Delete without Reload
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('modals')
<!-- Create Modal -->
<div class="modal fade" id="btnFormModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('articles.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add New Article</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="articleTitle" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="articleTitle" placeholder="Enter Article Title" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="articleDoctor" class="form-label">Author (Doctor)</label>
                        <select name="doctor_id" class="form-select" id="articleDoctor" required>
                            <option value="">Select Doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="articleContent" class="form-label">Content</label>
                        <textarea name="content" class="form-control" id="articleContent" rows="4" placeholder="Write article content here..." required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="articleStatus" class="form-label">Status</label>
                        <select name="status" class="form-select" id="articleStatus" required>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="articleViews" class="form-label">Views Count</label>
                        <input type="number" name="views_count" class="form-control" id="articleViews" value="0" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal A -->
<div class="modal fade" id="modalEditA" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Article (Type A)</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                {{-- Loaded via Ajax --}}
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal B -->
<div class="modal fade" id="modalEditB" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Article (Type B)</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContentB">
                {{-- Loaded via Ajax --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endpush

@section('scripts')
<script>
function getEditForm(id) {
    $.ajax({
        type: 'POST',
        url: '{{ route("article.getEditForm") }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'id': id
        },
        success: function(data) {
            $('#modalContent').html(data.msg);
        }
    });
}

function getEditFormB(id) {
    $.ajax({
        type: 'POST',
        url: '{{ route("article.getEditFormB") }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'id': id
        },
        success: function(data) {
            $('#modalContentB').html(data.msg);
        }
    });
}

function saveDataUpdate(id) {
    var title = $('#article_title_b').val();
    var doctor_id = $('#article_doctor_b').val();
    var content = $('#article_content_b').val();
    var status = $('#article_status_b').val();
    var views_count = $('#article_views_b').val();

    $.ajax({
        type: 'POST',
        url: '{{ route("article.saveDataUpdate") }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'id': id,
            'title': title,
            'doctor_id': doctor_id,
            'content': content,
            'status': status,
            'views_count': views_count
        },
        success: function(data) {
            if (data.status == "oke") {
                $('#td_title_' + id).html(title);
                $('#td_doctor_' + id).html(data.doctor_name);
                
                var statusBadge = status === 'published' 
                    ? '<span class="badge bg-success">Published</span>' 
                    : '<span class="badge bg-secondary">Draft</span>';
                $('#td_status_' + id).html(statusBadge);
                $('#td_views_' + id).html(views_count);

                $('#modalEditB').modal('hide');
            }
        },
        error: function(err) {
            alert('Failed to update. Check input data validation.');
        }
    });
}

function deleteDataRemove(id) {
    $.ajax({
        type: 'POST',
        url: '{{ route("article.deleteData") }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'id': id
        },
        success: function(data) {
            if (data.status == "oke") {
                $('#tr_' + id).remove();
            }
        },
        error: function(err) {
            alert('Failed to delete article.');
        }
    });
}
</script>
@endsection
