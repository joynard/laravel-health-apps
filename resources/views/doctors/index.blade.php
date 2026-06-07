@extends('layouts.adminlte4')

@section('title', 'Doctors')

@section('active-menu-doctor', 'active')

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
    <h4 class="text-secondary fw-bold mb-0">Manage Doctors</h4>
    <div>
        <button type="button" class="btn btn-warning rounded-pill px-4 shadow-sm me-2" data-bs-toggle="modal" data-bs-target="#btnFormModal">
            <i class="bi bi-plus-lg me-2"></i>New Doctor (with Modals)
        </button>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-secondary fw-semibold">Doctors Table</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Consultation Fee</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($doctors as $doctor)
                        <tr id="tr_{{ $doctor->id }}">
                            <td>{{ $doctor->id }}</td>
                            <td id="td_name_{{ $doctor->id }}">{{ $doctor->name }}</td>
                            <td id="td_email_{{ $doctor->id }}">{{ $doctor->email }}</td>
                            <td id="td_status_{{ $doctor->id }}">
                                @if($doctor->status == 'active')
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td id="td_fee_{{ $doctor->id }}">Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }}</td>
                            <td>
                                <a href="#modalEditA" class="btn btn-sm btn-warning rounded-pill px-3 me-1" data-bs-toggle="modal" onclick="getEditForm({{ $doctor->id }})">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit Type A
                                </a>

                                <a href="#modalEditB" class="btn btn-sm btn-primary rounded-pill px-3 me-1" data-bs-toggle="modal" onclick="getEditFormB({{ $doctor->id }})">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit Type B
                                </a>

                                <a href="#" class="btn btn-sm btn-danger rounded-pill px-3" onclick="if(confirm('Are you sure to delete Dr. {{ $doctor->name }}?')) deleteDataRemove({{ $doctor->id }}); return false;">
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
            <form method="POST" action="{{ route('doctors.store') }}">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add New Doctor</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="doctorName" class="form-label">Doctor Name</label>
                        <input type="text" name="name" class="form-control" id="doctorName" placeholder="Enter Doctor Name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="doctorEmail" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="doctorEmail" placeholder="Enter Email Address" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="doctorStatus" class="form-label">Status</label>
                        <select name="status" class="form-select" id="doctorStatus" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="doctorFee" class="form-label">Consultation Fee (Rp)</label>
                        <input type="number" name="consultation_fee" class="form-control" id="doctorFee" placeholder="Enter Consultation Fee" required>
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
                <h4 class="modal-title">Edit Doctor (Type A)</h4>
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
                <h4 class="modal-title">Edit Doctor (Type B)</h4>
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
        url: '{{ route("doctor.getEditForm") }}',
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
        url: '{{ route("doctor.getEditFormB") }}',
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
    var name = $('#doctor_name_b').val();
    var email = $('#doctor_email_b').val();
    var status = $('#doctor_status_b').val();
    var consultation_fee = $('#doctor_fee_b').val();

    $.ajax({
        type: 'POST',
        url: '{{ route("doctor.saveDataUpdate") }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'id': id,
            'name': name,
            'email': email,
            'status': status,
            'consultation_fee': consultation_fee
        },
        success: function(data) {
            if (data.status == "oke") {
                $('#td_name_' + id).html(name);
                $('#td_email_' + id).html(email);
                
                var statusBadge = status === 'active' 
                    ? '<span class="badge bg-success">Active</span>' 
                    : '<span class="badge bg-secondary">Inactive</span>';
                $('#td_status_' + id).html(statusBadge);

                // format currency
                var formattedFee = 'Rp ' + parseInt(consultation_fee).toLocaleString('id-ID');
                $('#td_fee_' + id).html(formattedFee);

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
        url: '{{ route("doctor.deleteData") }}',
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
            alert('Failed to delete doctor. It may be linked to other records.');
        }
    });
}
</script>
@endsection
