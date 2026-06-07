@extends('layouts.adminlte4')

@section('title', 'Edit Service')

@section('active-menu-service', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10 col-lg-8">
        <div class="card card-warning card-outline shadow-lg border-0 rounded-4">
            <div class="card-header bg-white py-3 border-0">
                <h3 class="card-title text-warning fw-bold mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Service
                </h3>
            </div>
            <form action="{{ route('services.update', $service->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="card-body py-4">
                    <div class="row">
                        <!-- Left Column: Name & Category -->
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="name" class="form-label fw-semibold text-secondary">Service Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-gear text-muted"></i>
                                    </span>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                        placeholder="Enter service name" 
                                        value="{{ old('name', $service->name) }}" 
                                        required
                                    >
                                    <div class="invalid-feedback">
                                        Please enter a service name.
                                    </div>
                                    @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="category_id" class="form-label fw-semibold text-secondary">Category</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-list-task text-muted"></i>
                                    </span>
                                    <select 
                                        name="category_id" 
                                        id="category_id" 
                                        class="form-select border-start-0 @error('category_id') is-invalid @enderror" 
                                        required
                                    >
                                        <option value="" disabled>-- Select Category --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a category.
                                    </div>
                                    @error('category_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Availability & Price -->
                        <div class="col-md-6">
                            <div class="form-group mb-4">
                                <label for="availability" class="form-label fw-semibold text-secondary">Availability Date</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0">
                                        <i class="bi bi-calendar-event text-muted"></i>
                                    </span>
                                    <input 
                                        type="date" 
                                        name="availability" 
                                        id="availability" 
                                        class="form-control border-start-0 @error('availability') is-invalid @enderror" 
                                        value="{{ old('availability', $service->availability) }}" 
                                        required
                                    >
                                    <div class="invalid-feedback">
                                        Please choose an availability date.
                                    </div>
                                    @error('availability')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label for="price" class="form-label fw-semibold text-secondary">Price (IDR)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0 fw-semibold text-secondary">Rp</span>
                                    <input 
                                        type="number" 
                                        step="0.01" 
                                        name="price" 
                                        id="price" 
                                        class="form-control border-start-0 @error('price') is-invalid @enderror" 
                                        placeholder="0.00" 
                                        value="{{ old('price', $service->price) }}" 
                                        required
                                    >
                                    <div class="invalid-feedback">
                                        Please enter a valid price.
                                    </div>
                                    @error('price')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description" class="form-label fw-semibold text-secondary">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            rows="4" 
                            class="form-control @error('description') is-invalid @enderror" 
                            placeholder="Enter service details and description..." 
                            required
                        >{{ old('description', $service->description) }}</textarea>
                        <div class="invalid-feedback">
                            Please provide a service description.
                        </div>
                        @error('description')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer bg-light py-3 border-top d-flex justify-content-between">
                    <a href="{{ route('services.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                    <button type="submit" class="btn btn-warning px-4 rounded-pill shadow-sm text-white fw-semibold">
                        <i class="bi bi-save me-2"></i>Update Service
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
