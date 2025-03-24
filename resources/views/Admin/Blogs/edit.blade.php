@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h2 class="mb-0">Edit Blog</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- This is required for Laravel to recognize it as an update -->

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="5" required>{{ old('content', $blog->content) }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Current Image</label>
                    <div>
                        @if($blog->image)
                            <img src="{{ asset('storage/' . $blog->image) }}" class="img-thumbnail" width="120">
                        @else
                            <span class="text-muted">No Image</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Change Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.blogs') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Blogs
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
