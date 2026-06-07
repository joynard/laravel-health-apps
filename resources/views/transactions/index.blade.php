@extends('layouts.adminlte4')

@section('title', 'Transactions')

@section('active-menu-transaction', 'active')

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
    <h4 class="text-secondary fw-bold mb-0">Manage Transactions</h4>
    <a href="{{ route('transactions.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
        <i class="bi bi-plus-lg me-2"></i>New Transaction
    </a>
</div>

<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3">
                <h3 class="card-title text-secondary fw-semibold mb-0">Transactions Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover align-middle text-nowrap mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Code</th>
                            <th>Patient (User)</th>
                            <th>Doctor</th>
                            <th>Services Used (Qty)</th>
                            <th>Base Fees</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                        <tr id="tr_{{ $transaction->id }}">
                            <td>
                                <span class="badge bg-light text-primary font-monospace fw-bold py-2 px-3 rounded">
                                    {{ $transaction->transaction_code }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold">{{ $transaction->user ? $transaction->user->name : 'N/A' }}</div>
                                <small class="text-muted">ID: {{ $transaction->user_id }}</small>
                            </td>
                            <td>
                                <div>Dr. {{ $transaction->doctor ? $transaction->doctor->name : 'N/A' }}</div>
                                <small class="text-muted">Fee: Rp {{ number_format($transaction->consultation_fee, 0, ',', '.') }}</small>
                            </td>
                            <td>
                                @if($transaction->services->isNotEmpty())
                                    <ul class="list-unstyled mb-0">
                                        @foreach($transaction->services as $service)
                                            <li>
                                                <i class="bi bi-check2-circle text-success me-1"></i>
                                                {{ $service->name }} 
                                                <span class="badge bg-secondary rounded-pill">
                                                    x{{ $service->pivot->quantity }}
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-secondary d-block">Consultation: Rp {{ number_format($transaction->consultation_fee, 0, ',', '.') }}</small>
                                <small class="text-secondary d-block">Admin: Rp {{ number_format($transaction->admin_fee, 0, ',', '.') }}</small>
                            </td>
                            <td>
                                <span class="fw-bold text-success">
                                    Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                                </span>
                            </td>
                            <td id="td_status_{{ $transaction->id }}">
                                <!-- Payment Status Badge -->
                                @if($transaction->payment_status == 'paid')
                                    <span class="badge bg-success rounded-pill px-3 py-2">Paid</span>
                                @elseif($transaction->payment_status == 'failed')
                                    <span class="badge bg-danger rounded-pill px-3 py-2">Failed</span>
                                @else
                                    <span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>
                                @endif
                                
                                <!-- Transaction Status Badge -->
                                @if($transaction->transaction_status == 'completed')
                                    <span class="badge bg-success rounded-pill px-3 py-2 ms-1">Completed</span>
                                @elseif($transaction->transaction_status == 'cancelled')
                                    <span class="badge bg-danger rounded-pill px-3 py-2 ms-1">Cancelled</span>
                                @elseif($transaction->transaction_status == 'ongoing')
                                    <span class="badge bg-info text-white rounded-pill px-3 py-2 ms-1">Ongoing</span>
                                @else
                                    <span class="badge bg-secondary rounded-pill px-3 py-2 ms-1">Waiting</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $transaction->created_at ? $transaction->created_at->format('d M Y H:i') : '-' }}
                                </small>
                            </td>
                            <td>
                                <a href="{{ route('transactions.edit', $transaction->id) }}" 
                                   class="btn btn-sm btn-outline-warning rounded-pill px-3 me-1">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit (Normal)
                                </a>

                                <a href="#modalEditA" class="btn btn-sm btn-warning rounded-pill px-3 me-1" data-bs-toggle="modal" onclick="getEditForm({{ $transaction->id }})">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit Type A
                                </a>

                                <a href="#modalEditB" class="btn btn-sm btn-primary rounded-pill px-3 me-1" data-bs-toggle="modal" onclick="getEditFormB({{ $transaction->id }})">
                                    <i class="bi bi-pencil-fill me-1"></i>Edit Type B
                                </a>

                                <form action="{{ route('transactions.destroy', $transaction->id) }}" 
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

                                <a href="#" class="btn btn-sm btn-danger rounded-pill px-3" onclick="if(confirm('Are you sure to delete this transaction?')) deleteDataRemove({{ $transaction->id }}); return false;">
                                    <i class="bi bi-trash-fill me-1"></i>Delete without Reload
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-1 d-block mb-3"></i>
                                No transaction data found.
                            </td>
                        </tr>
                        @endforelse
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
<!-- Edit Modal A -->
<div class="modal fade" id="modalEditA" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Transaction Status (Type A)</h4>
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
                <h4 class="modal-title">Edit Transaction Status (Type B)</h4>
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
        url: '{{ route("transaction.getEditForm") }}',
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
        url: '{{ route("transaction.getEditFormB") }}',
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
    var payment_status = $('#payment_status_b').val();
    var transaction_status = $('#transaction_status_b').val();

    $.ajax({
        type: 'POST',
        url: '{{ route("transaction.saveDataUpdate") }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'id': id,
            'payment_status': payment_status,
            'transaction_status': transaction_status
        },
        success: function(data) {
            if (data.status == "oke") {
                // Prepare new status badges
                var paymentBadge = '';
                if (payment_status === 'paid') {
                    paymentBadge = '<span class="badge bg-success rounded-pill px-3 py-2">Paid</span>';
                } else if (payment_status === 'failed') {
                    paymentBadge = '<span class="badge bg-danger rounded-pill px-3 py-2">Failed</span>';
                } else {
                    paymentBadge = '<span class="badge bg-warning text-dark rounded-pill px-3 py-2">Pending</span>';
                }

                var transactionBadge = '';
                if (transaction_status === 'completed') {
                    transactionBadge = '<span class="badge bg-success rounded-pill px-3 py-2 ms-1">Completed</span>';
                } else if (transaction_status === 'cancelled') {
                    transactionBadge = '<span class="badge bg-danger rounded-pill px-3 py-2 ms-1">Cancelled</span>';
                } else if (transaction_status === 'ongoing') {
                    transactionBadge = '<span class="badge bg-info text-white rounded-pill px-3 py-2 ms-1">Ongoing</span>';
                } else {
                    transactionBadge = '<span class="badge bg-secondary rounded-pill px-3 py-2 ms-1">Waiting</span>';
                }

                $('#td_status_' + id).html(paymentBadge + ' ' + transactionBadge);
                $('#modalEditB').modal('hide');
            }
        },
        error: function(err) {
            alert('Failed to update status.');
        }
    });
}

function deleteDataRemove(id) {
    $.ajax({
        type: 'POST',
        url: '{{ route("transaction.deleteData") }}',
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
            alert('Failed to delete transaction.');
        }
    });
}
</script>
@endsection
