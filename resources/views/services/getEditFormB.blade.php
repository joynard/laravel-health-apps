<h3>Update Service (Type B)</h3>
@csrf
@method('PUT')
<div class="form-group mb-3">
    <label for="service_name_b" class="form-label">Service Name</label>
    <input type="text" class="form-control" id="service_name_b" value="{{ $data->name }}" required>
</div>
<div class="form-group mb-3">
    <label for="service_desc_b" class="form-label">Description</label>
    <textarea class="form-control" id="service_desc_b" rows="3" required>{{ $data->description }}</textarea>
</div>
<div class="form-group mb-3">
    <label for="service_availability_b" class="form-label">Availability Date</label>
    <input type="date" class="form-control" id="service_availability_b" value="{{ $data->availability }}" required>
</div>
<div class="form-group mb-3">
    <label for="service_price_b" class="form-label">Price (Rp)</label>
    <input type="number" class="form-control" id="service_price_b" value="{{ (int)$data->price }}" required>
</div>
<div class="form-group mb-3">
    <label for="service_category_b" class="form-label">Category</label>
    <select class="form-select" id="service_category_b" required>
        @foreach($categories as $category)
            <option value="{{ $category->id }}" {{ $data->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<button type="button" onClick="saveDataUpdate({{ $data->id }})" class="btn btn-primary mt-2" data-bs-dismiss="modal">Submit</button>
