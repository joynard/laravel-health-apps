<h3>Update Service Details</h3>
<form method="POST" action="{{ route('services.update', $data->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="service_name_a" class="form-label">Service Name</label>
        <input type="text" class="form-control" id="service_name_a" name="name" value="{{ $data->name }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="service_desc_a" class="form-label">Description</label>
        <textarea class="form-control" id="service_desc_a" name="description" rows="3" required>{{ $data->description }}</textarea>
    </div>
    <div class="form-group mb-3">
        <label for="service_availability_a" class="form-label">Availability Date</label>
        <input type="date" class="form-control" id="service_availability_a" name="availability" value="{{ $data->availability }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="service_price_a" class="form-label">Price (Rp)</label>
        <input type="number" class="form-control" id="service_price_a" name="price" value="{{ (int)$data->price }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="service_category_a" class="form-label">Category</label>
        <select class="form-select" id="service_category_a" name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $data->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>
