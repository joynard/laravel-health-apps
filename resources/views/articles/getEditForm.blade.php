<h3>Update Article Details</h3>
<form method="POST" action="{{ route('articles.update', $data->id) }}">
    @csrf
    @method('PUT')
    <div class="form-group mb-3">
        <label for="article_title_a" class="form-label">Title</label>
        <input type="text" class="form-control" id="article_title_a" name="title" placeholder="Enter Title" value="{{ $data->title }}" required>
    </div>
    <div class="form-group mb-3">
        <label for="article_doctor_a" class="form-label">Author (Doctor)</label>
        <select class="form-select" id="article_doctor_a" name="doctor_id" required>
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" {{ $data->doctor_id == $doctor->id ? 'selected' : '' }}>{{ $doctor->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="article_content_a" class="form-label">Content</label>
        <textarea class="form-control" id="article_content_a" name="content" rows="4" required>{{ $data->content }}</textarea>
    </div>
    <div class="form-group mb-3">
        <label for="article_status_a" class="form-label">Status</label>
        <select class="form-select" id="article_status_a" name="status" required>
            <option value="draft" {{ $data->status == 'draft' ? 'selected' : '' }}>Draft</option>
            <option value="published" {{ $data->status == 'published' ? 'selected' : '' }}>Published</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="article_views_a" class="form-label">Views Count</label>
        <input type="number" class="form-control" id="article_views_a" name="views_count" value="{{ $data->views_count }}" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Submit</button>
</form>
