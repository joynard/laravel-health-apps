@extends('layouts.adminlte4')

@section('title', 'Record Transaction')

@section('active-menu-transaction', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card card-primary card-outline shadow-lg border-0 rounded-4">
            <div class="card-header bg-white py-3 border-0">
                <h3 class="card-title text-primary fw-bold mb-0">
                    <i class="bi bi-cart-plus-fill me-2"></i>Record New Transaction
                </h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{ route('transactions.store') }}" method="POST" class="needs-validation" novalidate>
                @csrf
                <div class="card-body py-4">
                    <div class="row">
                        <!-- Left Column: Patient & Doctor Selection -->
                        <div class="col-md-6">
                            <!-- Patient Selector -->
                            <div class="form-group mb-4">
                                <label for="user_id" class="form-label fw-semibold text-secondary">Patient / User</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-person text-muted"></i>
                                    </span>
                                    <select 
                                        name="user_id" 
                                        id="user_id" 
                                        class="form-select border-start-0 @error('user_id') is-invalid @enderror" 
                                        required
                                    >
                                        <option value="" disabled selected>-- Select Patient --</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }} (ID: {{ $user->id }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a patient.
                                    </div>
                                    @error('user_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Doctor Selector -->
                            <div class="form-group mb-4">
                                <label for="doctor_id" class="form-label fw-semibold text-secondary">Doctor</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-person-badge text-muted"></i>
                                    </span>
                                    <select 
                                        name="doctor_id" 
                                        id="doctor_id" 
                                        class="form-select border-start-0 @error('doctor_id') is-invalid @enderror" 
                                        required
                                    >
                                        <option value="" disabled selected>-- Select Doctor --</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}" {{ old('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                                {{ $doctor->name }} (Fee: Rp {{ number_format($doctor->consultation_fee, 0, ',', '.') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a doctor.
                                    </div>
                                    @error('doctor_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Service & Quantity Selection -->
                        <div class="col-md-6">
                            <!-- Service Combo Box -->
                            <div class="form-group mb-4">
                                <label for="service_id" class="form-label fw-semibold text-secondary">Service</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-box-seam text-muted"></i>
                                    </span>
                                    <select 
                                        name="service_id" 
                                        id="service_id" 
                                        class="form-select border-start-0 @error('service_id') is-invalid @enderror" 
                                        required
                                    >
                                        <option value="" disabled selected>-- Select Service --</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                                {{ $service->name }} (Price: Rp {{ number_format($service->price, 0, ',', '.') }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a service.
                                    </div>
                                    @error('service_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Quantity Field -->
                            <div class="form-group mb-4">
                                <label for="quantity" class="form-label fw-semibold text-secondary">Quantity</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-hash text-muted"></i>
                                    </span>
                                    <input 
                                        type="number" 
                                        name="quantity" 
                                        id="quantity" 
                                        min="1" 
                                        class="form-control border-start-0 @error('quantity') is-invalid @enderror" 
                                        placeholder="Enter quantity" 
                                        value="{{ old('quantity', 1) }}" 
                                        required
                                    >
                                    <div class="invalid-feedback">
                                        Please enter a quantity of 1 or more.
                                    </div>
                                    @error('quantity')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer bg-light py-3 border-top d-flex justify-content-between">
                    <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                    <button type="submit" class="btn btn-primary px-4 rounded-pill shadow-sm">
                        <i class="bi bi-save me-2"></i>Save Transaction
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
