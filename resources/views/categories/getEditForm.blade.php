<h3>Update Category</h3>
<form method="POST" action="{{ route('categories.update', $data->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="name">Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Category Name" value="{{ $data->name }}" required>
        <small class="form-text text-muted">Please write down Category Name here.</small>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
