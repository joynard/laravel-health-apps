<h3>Update Article (Type B)</h3>
@csrf
@method('PUT')
<div class="form-group mb-3">
    <label for="article_title_b" class="form-label">Title</label>
    <input type="text" class="form-control" id="article_title_b" placeholder="Enter Title" value="{{ $data->title }}" required>
</div>
<div class="form-group mb-3">
    <label for="article_doctor_b" class="form-label">Author (Doctor)</label>
    <select class="form-select" id="article_doctor_b" required>
        @foreach($doctors as $doctor)
            <option value="{{ $doctor->id }}" {{ $data->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group mb-3">
    <label for="article_content_b" class="form-label">Content</label>
    <textarea class="form-control" id="article_content_b" rows="4" required>{{ $data->content }}</textarea>
</div>
<div class="form-group mb-3">
    <label for="article_status_b" class="form-label">Status</label>
    <select class="form-select" id="article_status_b" required>
        <option value="draft" {{ $data->status == 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="published" {{ $data->status == 'published' ? 'selected' : '' }}>Published</option>
    </select>
</div>
<div class="form-group mb-3">
    <label for="article_views_b" class="form-label">Views Count</label>
    <input type="number" class="form-control" id="article_views_b" value="{{ $data->views_count }}" required>
</div>
<button type="button" onClick="saveDataUpdate({{ $data->id }})" class="btn btn-primary mt-2" data-bs-dismiss="modal">Submit</button>
