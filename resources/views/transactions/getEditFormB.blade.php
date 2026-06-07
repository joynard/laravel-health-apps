<h3>Update Transaction Status (Type B)</h3>
@csrf
@method('PUT')
<div class="form-group mb-3">
    <label for="payment_status_b" class="form-label">Payment Status</label>
    <select class="form-select" id="payment_status_b" required>
        <option value="pending" {{ $data->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="paid" {{ $data->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
        <option value="failed" {{ $data->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
    </select>
</div>
<div class="form-group mb-3">
    <label for="transaction_status_b" class="form-label">Transaction Status</label>
    <select class="form-select" id="transaction_status_b" required>
        <option value="waiting" {{ $data->transaction_status == 'waiting' ? 'selected' : '' }}>Waiting</option>
        <option value="ongoing" {{ $data->transaction_status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
        <option value="completed" {{ $data->transaction_status == 'completed' ? 'selected' : '' }}>Completed</option>
        <option value="cancelled" {{ $data->transaction_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
    </select>
</div>
<button type="button" onClick="saveDataUpdate({{ $data->id }})" class="btn btn-primary mt-2" data-bs-dismiss="modal">Submit</button>
