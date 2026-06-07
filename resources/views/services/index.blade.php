@extends('layouts.adminlte4')

@section('title', 'Services')

@section('active-menu-service', 'active')

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
    <h4 class="text-secondary fw-bold mb-0">Manage Services</h4>
    <div>
        <button type="button" class="btn btn-warning rounded-pill px-4 shadow-sm me-2" data-bs-toggle="modal" data-bs-target="#btnFormModal">
            <i class="bi bi-plus-lg me-2"></i>New Service (with Modals)
        </button>
        <a href="{{ route('services.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="bi bi-plus-lg me-2"></i>New Service
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-secondary fw-semibold">Services Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service Name</th>
                            <th>Description</th>
                            <th>Availability</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                        <tr id="tr_{{ $service->id }}">
                            <td>{{ $service->id }}</td>
                            <td id="td_name_{{ $service->id }}">{{ $service->name }}</td>
                            <td id="td_description_{{ $service->id }}">{{ \Illuminate\Support\Str::limit($service->description, 40) }}</td>
                            <td id="td_availability_{{ $service->id }}">{{ $service->availability }}</td>
                            <td id="td_price_{{ $service->id }}">Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                            <td id="td_category_{{ $service->id }}">
                                {{ $service->category ? $service->category->name : '-' }}
                            </td>
                            <td>
                                <a href="#modalEditA" class="btn btn-sm btn-warning rounded-pill px-3 me-1" data-bs-toggle="modal" onclick="getEditForm({{ $service->id }})">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit Type A
                                </a>

                                <a href="#modalEditB" class="btn btn-sm btn-primary rounded-pill px-3 me-1" data-bs-toggle="modal" onclick="getEditFormB({{ $service->id }})">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit Type B
                                </a>

                                <a href="#" class="btn btn-sm btn-danger rounded-pill px-3" onclick="if(confirm('Are you sure to delete service {{ $service->name }}?')) deleteDataRemove({{ $service->id }}); return false;">
                                    <i class="bi bi-trash-fill me-1"></i>Delete without Reload
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@endsection

@push('modals')
<!-- Create Modal -->
<div class="modal fade" id="btnFormModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('services.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add New Service</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="serviceName" class="form-label">Service Name</label>
                        <input type="text" name="name" class="form-control" id="serviceName" placeholder="Enter Service Name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="serviceDesc" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="serviceDesc" rows="3" placeholder="Enter Description" required></textarea>
                    </div>
                    <div class="form-group mb-3">
                        <label for="serviceAvailability" class="form-label">Availability Date</label>
                        <input type="date" name="availability" class="form-control" id="serviceAvailability" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="servicePrice" class="form-label">Price (Rp)</label>
                        <input type="number" name="price" class="form-control" id="servicePrice" placeholder="Enter Price" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="serviceCategory" class="form-label">Category</label>
                        <select name="category_id" class="form-select" id="serviceCategory" required>
                            <option value="">Select Category</option>
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
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
                <h4 class="modal-title">Edit Service (Type A)</h4>
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
                <h4 class="modal-title">Edit Service (Type B)</h4>
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
        url: '{{ route("service.getEditForm") }}',
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
        url: '{{ route("service.getEditFormB") }}',
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
    var name = $('#service_name_b').val();
    var description = $('#service_desc_b').val();
    var availability = $('#service_availability_b').val();
    var price = $('#service_price_b').val();
    var category_id = $('#service_category_b').val();

    $.ajax({
        type: 'POST',
        url: '{{ route("service.saveDataUpdate") }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'id': id,
            'name': name,
            'description': description,
            'availability': availability,
            'price': price,
            'category_id': category_id
        },
        success: function(data) {
            if (data.status == "oke") {
                $('#td_name_' + id).html(name);
                
                // Show limited description
                var limitedDesc = description.length > 40 ? description.substring(0, 40) + '...' : description;
                $('#td_description_' + id).html(limitedDesc);
                $('#td_availability_' + id).html(availability);

                // format currency
                var formattedPrice = 'Rp ' + parseInt(price).toLocaleString('id-ID');
                $('#td_price_' + id).html(formattedPrice);
                $('#td_category_' + id).html(data.category_name);

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
        url: '{{ route("service.deleteData") }}',
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
            alert('Failed to delete service. It may be linked to other records.');
        }
    });
}
</script>
@endsection