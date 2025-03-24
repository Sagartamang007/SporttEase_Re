@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom border-light py-3">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-edit text-primary me-3 fs-4"></i>
                        <h3 class="mb-0 fw-bold">Add New Blog</h3>
                    </div>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data" class="blog-form">
                        @csrf
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label fw-medium">Blog Title</label>
                                <input type="text" name="title" class="form-control form-control-lg" placeholder="Enter blog title" required>
                                <div class="form-text">Choose a clear and engaging title for your blog post.</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label fw-medium">Blog Content</label>
                                <textarea name="content" class="form-control" rows="8" placeholder="Write your blog content here..." required></textarea>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label fw-medium">Featured Image</label>
                                <div class="image-upload-container">
                                    <input type="file" name="image" id="image-upload" class="form-control" accept="image/*">
                                    <div class="image-preview mt-3 d-none" id="image-preview">
                                        <img src="/placeholder.svg" alt="Preview" id="preview-img">
                                        <button type="button" class="btn btn-sm btn-danger remove-preview">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="form-text">Recommended image size: 1200 x 630 pixels (16:9 ratio)</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4 pt-2 border-top">
                            <a href="{{ route('admin.blogs') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="fas fa-save me-1"></i> Save Blog
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Enhanced styling */
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .form-control {
        border-color: #e2e8f0;
        padding: 0.6rem 1rem;
    }

    .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.1);
    }

    .form-control-lg {
        font-size: 1.1rem;
    }

    .form-label {
        color: #4b5563;
        margin-bottom: 0.5rem;
    }

    .form-text {
        color: #6b7280;
    }

    .image-upload-container {
        position: relative;
    }

    .image-preview {
        position: relative;
        display: inline-block;
        margin-top: 10px;
    }

    .image-preview img {
        max-height: 200px;
        border-radius: 8px;
        border: 2px solid #e2e8f0;
    }

    .remove-preview {
        position: absolute;
        top: -10px;
        right: -10px;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary {
        background-color: #3b82f6;
        border-color: #3b82f6;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-primary:hover {
        background-color: #2563eb;
        border-color: #2563eb;
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(37, 99, 235, 0.1);
    }

    .btn-outline-secondary {
        font-weight: 500;
    }

    .fw-medium {
        font-weight: 500;
    }

    textarea {
        resize: vertical;
        min-height: 150px;
    }
</style>

<script>
    // Add this script to your page for image preview functionality
    document.addEventListener('DOMContentLoaded', function() {
        const imageUpload = document.getElementById('image-upload');
        const imagePreview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');
        const removePreview = document.querySelector('.remove-preview');

        imageUpload.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

        removePreview.addEventListener('click', function() {
            imagePreview.classList.add('d-none');
            imageUpload.value = '';
        });
    });
</script>
@endsection
