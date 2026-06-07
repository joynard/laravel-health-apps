<h3>Update Doctor (Type B)</h3>
@csrf
@method('PUT')
<div class="form-group mb-3">
    <label for="doctor_name_b" class="form-label">Doctor Name</label>
    <input type="text" class="form-control" id="doctor_name_b" placeholder="Enter Doctor Name" value="{{ $data->name }}" required>
</div>
<div class="form-group mb-3">
    <label for="doctor_email_b" class="form-label">Email Address</label>
    <input type="email" class="form-control" id="doctor_email_b" placeholder="Enter Email" value="{{ $data->email }}" required>
</div>
<div class="form-group mb-3">
    <label for="doctor_status_b" class="form-label">Status</label>
    <select class="form-select" id="doctor_status_b" required>
        <option value="active" {{ $data->status == 'active' ? 'selected' : '' }}>Active</option>
        <option value="inactive" {{ $data->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
    </select>
</div>
<div class="form-group mb-3">
    <label for="doctor_fee_b" class="form-label">Consultation Fee (Rp)</label>
    <input type="number" class="form-control" id="doctor_fee_b" placeholder="Enter Consultation Fee" value="{{ (int)$data->consultation_fee }}" required>
</div>
<button type="button" onClick="saveDataUpdate({{ $data->id }})" class="btn btn-primary mt-2" data-bs-dismiss="modal">Submit</button>
