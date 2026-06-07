<h3>Update Category</h3>
@csrf
@method('PUT')
<div class="form-group mb-3">
    <label for="cname">Name</label>
    <input type="text" name="namecate" class="form-control" id="cname" placeholder="Enter name of category" value="{{ $data->name }}" required>
    <small class="form-text text-muted">Please write down Category Name here.</small>
</div>
<button type="button" onClick="saveDataUpdate({{ $data->id }})" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
