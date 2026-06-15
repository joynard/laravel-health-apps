@extends('layouts.adminlte4')

@section('title', 'Categories')

@section('active-menu-category', 'active')

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
    <h4 class="text-secondary fw-bold mb-0">Manage Categories</h4>
    <div>
        <button type="button" class="btn btn-warning rounded-pill px-4 shadow-sm me-2" data-bs-toggle="modal" data-bs-target="#btnFormModal">
            <i class="bi bi-plus-lg me-2"></i>New Category (with Modals)
        </button>
        <a href="{{ route('categories.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>New Category
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-secondary fw-semibold">Categories Table</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categories Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr id="tr_{{ $category->id }}">
                            <td>{{ $category->id }}</td>
                            <td id="td_name_{{ $category->id }}">{{ $category->name }}</td>
                            <td>
                                <a href="{{ route('categories.edit', $category->id) }}" 
                                   class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit (Normal)
                                </a>

                                <a href="#modalEditA" class="btn btn-sm btn-warning rounded-pill px-3 me-1" data-bs-toggle="modal" onclick="getEditForm({{ $category->id }})">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit Type A
                                </a>

                                <a href="#modalEditB" class="btn btn-sm btn-primary rounded-pill px-3 me-1" data-bs-toggle="modal" onclick="getEditFormB({{ $category->id }})">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit Type B
                                </a>

                                @can('delete-permission', Auth::user())
                                <form action="{{ route('categories.destroy', $category->id) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-outline-danger rounded-pill px-3 me-1"
                                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">
                                        <i class="bi bi-trash-fill me-1"></i>Delete (Normal)
                                    </button>
                                </form>

                                <a href="#" class="btn btn-sm btn-danger rounded-pill px-3" onclick="if(confirm('Are you sure to delete {{ $category->id }} - {{ $category->name }} ?')) deleteDataRemove({{ $category->id }}); return false;">
                                    <i class="bi bi-trash-fill me-1"></i>Delete without Reload
                                </a>
                                @endcan
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
            <form method="POST" action="{{ route('categories.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add New Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="nameCategory" class="form-label">Name of Category</label>
                        <input type="text" name="name" class="form-control" id="nameCategory" aria-describedby="nameHelp" placeholder="Enter name of category" required>
                        <small id="nameHelp" class="form-text text-muted">Please write down Category Name here.</small>
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
                <h4 class="modal-title">Edit Your Category (Type A)</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                {{-- Konten Form HTML dari getEditForm.blade.php akan masuk ke sini via Ajax --}}
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal B -->
<div class="modal fade" id="modalEditB" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Your Category (Type B)</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContentB">
                {{-- Konten Form HTML dari getEditFormB.blade.php akan masuk ke sini --}}
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
        url: '{{ route("category.getEditForm") }}',
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
        url: '{{ route("category.getEditFormB") }}',
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
    var name = $('#cname').val(); // Mengambil value baru dari input form
    $.ajax({
        type: 'POST',
        url: '{{ route("category.saveDataUpdate") }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'id': id,
            'name': name
        },
        success: function(data) {
            if (data.status == "oke") {
                $('#td_name_' + id).html(name); // Update isi <td> secara realtime
                $('#modalEditB').modal('hide'); // Tutup modal otomatis
            }
        }
    });
}

function deleteDataRemove(id) {
    $.ajax({
        type: 'POST',
        url: '{{ route("category.deleteData") }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'id': id
        },
        success: function(data) {
            if (data.status == "oke") {
                $('#tr_' + id).remove(); // Menghilangkan baris tabel secara realtime dari client side
            }
        }
    });
}
</script>
@endsection
