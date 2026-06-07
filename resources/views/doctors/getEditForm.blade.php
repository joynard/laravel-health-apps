<h3>Update Doctor Details</h3>
<form method="POST" action="{{ route('doctors.update', $data->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="doctor_name_a" class="form-label">Doctor Name</label>
        <input type="text" class="form-control" id="doctor_name_a" name="name" placeholder="Enter Doctor Name" value="{{ $data->name }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="doctor_email_a" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="doctor_email_a" name="email" placeholder="Enter Email" value="{{ $data->email }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="doctor_status_a" class="form-label">Status</label>
        <select class="form-select" id="doctor_status_a" name="status" required>
            <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="doctor_fee_a" class="form-label">Consultation Fee (Rp)</label>
        <input type="number" class="form-control" id="doctor_fee_a" name="consultation_fee" placeholder="Enter Consultation Fee" value="{{ (int)$data->consultation_fee }}" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>
