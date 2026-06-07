@extends('layouts.adminlte4')

@section('title', 'Edit Transaction Status')

@section('active-menu-transaction', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card card-warning card-outline shadow-lg border-0 rounded-4">
            <div class="card-header bg-white py-3 border-0">
                <h3 class="card-title text-warning fw-bold mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Transaction Status
                </h3>
            </div>
            <div class="card-body pb-0 pt-4 px-4">
                <div class="alert alert-light border rounded-3">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted d-block">Transaction Code</small>
                            <strong class="font-monospace text-primary">{{ $transaction->transaction_code }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">Patient</small>
                            <strong>{{ $transaction->user ? $transaction->user->name : 'N/A' }}</strong>
                        </div>
                        <div class="col-md-6 mt-2">
                            <small class="text-muted d-block">Doctor</small>
                            <strong>Dr. {{ $transaction->doctor ? $transaction->doctor->name : 'N/A' }}</strong>
                        </div>
                        <div class="col-md-6 mt-2">
                            <small class="text-muted d-block">Total Price</small>
                            <strong class="text-success">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</strong>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('transactions.update', $transaction->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="card-body py-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="payment_status" class="form-label fw-semibold text-secondary">Payment Status</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-credit-card text-muted"></i>
                                    </span>
                                    <select 
                                        name="payment_status" 
                                        id="payment_status" 
                                        class="form-select border-start-0 @error('payment_status') is-invalid @enderror" 
                                        required
                                    >
                                        <option value="pending"  {{ old('payment_status',  $transaction->payment_status)  == 'pending'   ? 'selected' : '' }}>Pending</option>
                                        <option value="paid"     {{ old('payment_status',  $transaction->payment_status)  == 'paid'      ? 'selected' : '' }}>Paid</option>
                                        <option value="failed"   {{ old('payment_status',  $transaction->payment_status)  == 'failed'    ? 'selected' : '' }}>Failed</option>
                                    </select>
                                    @error('payment_status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="transaction_status" class="form-label fw-semibold text-secondary">Transaction Status</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-activity text-muted"></i>
                                    </span>
                                    <select 
                                        name="transaction_status" 
                                        id="transaction_status" 
                                        class="form-select border-start-0 @error('transaction_status') is-invalid @enderror" 
                                        required
                                    >
                                        <option value="waiting"   {{ old('transaction_status', $transaction->transaction_status) == 'waiting'   ? 'selected' : '' }}>Waiting</option>
                                        <option value="ongoing"   {{ old('transaction_status', $transaction->transaction_status) == 'ongoing'   ? 'selected' : '' }}>Ongoing</option>
                                        <option value="completed" {{ old('transaction_status', $transaction->transaction_status) == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ old('transaction_status', $transaction->transaction_status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                    @error('transaction_status')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light py-3 border-top d-flex justify-content-between">
                    <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                    <button type="submit" class="btn btn-warning px-4 rounded-pill shadow-sm text-white fw-semibold">
                        <i class="bi bi-save me-2"></i>Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Bootstrap validation script
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>
@endsection
