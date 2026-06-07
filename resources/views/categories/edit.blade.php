@extends('layouts.adminlte4')

@section('title', 'Edit Category')

@section('active-menu-category', 'active')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card card-warning card-outline shadow-lg border-0 rounded-4">
            <div class="card-header bg-white py-3 border-0">
                <h3 class="card-title text-warning fw-bold mb-0">
                    <i class="bi bi-pencil-square me-2"></i>Edit Category
                </h3>
            </div>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" class="needs-validation" novalidate>
                @csrf
                @method('PUT')
                <div class="card-body py-4">
                    <div class="form-group mb-4">
                        <label for="name" class="form-label fw-semibold text-secondary">Category Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-tag text-muted"></i>
                            </span>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                class="form-control border-start-0 @error('name') is-invalid @enderror" 
                                placeholder="Enter category name" 
                                value="{{ old('name', $category->name) }}" 
                                required
                            >
                            <div class="invalid-feedback">
                                Please enter a category name.
                            </div>
                            @error('name')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image" class="form-label fw-semibold text-secondary">Category Image URL (Optional)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-image text-muted"></i>
                            </span>
                            <input 
                                type="text" 
                                name="image" 
                                id="image" 
                                class="form-control border-start-0" 
                                placeholder="e.g. img/categories/dental.png" 
                                value="{{ old('image', $category->image) }}"
                            >
                        </div>
                        <small class="form-text text-muted">Leave blank to keep the current image.</small>
                    </div>
                </div>
                <div class="card-footer bg-light py-3 border-top d-flex justify-content-between">
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary px-4 rounded-pill">
                        <i class="bi bi-arrow-left me-2"></i>Back
                    </a>
                    <button type="submit" class="btn btn-warning px-4 rounded-pill shadow-sm text-white fw-semibold">
                        <i class="bi bi-save me-2"></i>Update Category
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
