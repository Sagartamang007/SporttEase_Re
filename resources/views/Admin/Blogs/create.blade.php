@extends('admin.layouts.app')

@section('content')
<style>
    /* Card Styles */
    .card-custom {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: all 0.3s ease;
    }

    .card-header-custom {
        background: linear-gradient(to right, #4e73df, #36b9cc);
        color: white;
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
        padding: 15px 20px;
    }

    /* Form Control Styles */
    .form-control-custom {
        border-radius: 6px;
        border: 1px solid #d1d3e2;
        padding: 12px 15px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .form-control-custom:focus {
        border-color: #4e73df;
        box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
    }

    .form-label-custom {
        font-weight: 600;
        color: #5a5c69;
        margin-bottom: 8px;
        font-size: 0.9rem;
    }

    /* Button Styles */
    .btn-add-custom {
        background: linear-gradient(145deg, #2ecc71, #27ae60);
        border: none;
        color: white;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(46, 204, 113, 0.3);
    }

    .btn-add-custom:hover {
        background: linear-gradient(145deg, #27ae60, #2ecc71);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(46, 204, 113, 0.4);
        color: white;
    }

    .btn-cancel-custom {
        background: linear-gradient(145deg, #f1f1f1, #e0e0e0);
        border: none;
        color: #5a5c69;
        border-radius: 6px;
        padding: 10px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .btn-cancel-custom:hover {
        background: linear-gradient(145deg, #e0e0e0, #f1f1f1);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    /* Image Preview Styles */
    .image-preview-container {
        position: relative;
        width: 150px;
        height: 150px;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border: 3px solid #fff;
        transition: all 0.3s ease;
        background-color: #f8f9fc;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .image-preview-container:hover {
        transform: scale(1.03);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
    }

    .image-preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .image-preview-placeholder {
        color: #d1d3e2;
        font-size: 3rem;
    }

    .image-preview-label {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        text-align: center;
        padding: 5px;
        font-size: 0.8rem;
    }

    /* File Input Styling */
    .file-input-container {
        position: relative;
        margin-bottom: 15px;
    }

    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8f9fc;
        border: 2px dashed #d1d3e2;
        border-radius: 6px;
        padding: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .file-input-label:hover {
        background: #eaecf4;
        border-color: #4e73df;
    }

    .file-input-label i {
        font-size: 1.5rem;
        color: #4e73df;
        margin-right: 10px;
    }

    .file-input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    /* Validation Styles */
    .is-invalid {
        border-color: #e74a3b !important;
    }

    .invalid-feedback {
        color: #e74a3b;
        font-size: 0.8rem;
        margin-top: 5px;
    }

    /* Required Field Indicator */
    .required-field::after {
        content: '*';
        color: #e74a3b;
        margin-left: 4px;
    }

    /* Rich Text Editor Styling */
    .editor-container {
        border: 1px solid #d1d3e2;
        border-radius: 6px;
        overflow: hidden;
    }

    .editor-toolbar {
        background: #f8f9fc;
        border-bottom: 1px solid #d1d3e2;
        padding: 8px;
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }

    .editor-btn {
        background: white;
        border: 1px solid #d1d3e2;
        border-radius: 4px;
        padding: 5px 10px;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .editor-btn:hover {
        background: #eaecf4;
        border-color: #4e73df;
    }

    /* Tips Card */
    .tips-card {
        background-color: #f8f9fc;
        border-left: 4px solid #4e73df;
        border-radius: 6px;
        padding: 15px;
        margin-bottom: 20px;
    }

    .tips-card h6 {
        color: #4e73df;
        margin-bottom: 10px;
    }

    .tips-card ul {
        padding-left: 20px;
        margin-bottom: 0;
    }

    .tips-card li {
        margin-bottom: 5px;
        font-size: 0.85rem;
    }
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">
            <i class="fas fa-newspaper text-primary me-2"></i>Add New Blog
        </h2>
        <a href="{{ route('blogs.index') }}" class="btn btn-cancel-custom">
            <i class="fas fa-arrow-left me-2"></i> Back to Blogs
        </a>
    </div>

    <div class="card card-custom shadow mb-4">
        <div class="card-header card-header-custom py-3">
            <h6 class="m-0 font-weight-bold">Create New Blog Post</h6>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label for="title" class="form-label form-label-custom required-field">Blog Title</label>
                            <input
                                type="text"
                                id="title"
                                name="title"
                                class="form-control form-control-custom @error('title') is-invalid @enderror"
                                value="{{ old('title') }}"
                                required
                                placeholder="Enter a clear and engaging title for your blog post"
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="content" class="form-label form-label-custom required-field">Blog Content</label>
                            <div class="editor-container">
                                <textarea
                                    id="content"
                                    name="content"
                                    class="form-control form-control-custom @error('content') is-invalid @enderror"
                                    rows="10"
                                    required
                                    placeholder="Write your blog content here..."
                                    style="border-radius: 0; border: none; border-top: 1px solid #d1d3e2;"
                                >{{ old('content') }}</textarea>
                            </div>
                            @error('content')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label form-label-custom required-field">Featured Image</label>
                            <div class="file-input-container">
                                <label for="image" class="file-input-label w-100">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <span>Choose an image or drag it here</span>
                                </label>
                                <input
                                    type="file"
                                    id="image"
                                    name="image"
                                    class="file-input @error('image') is-invalid @enderror"
                                    accept="image/*"
                                    required
                                    onchange="previewImage(this)"
                                >
                            </div>
                            @error('image')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Recommended size: 1200x630 pixels (16:9 ratio). Max file size: 2MB.</small>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="text-center mb-4">
                            <label class="form-label form-label-custom">Image Preview</label>
                            <div class="image-preview-container mx-auto">
                                <div id="placeholder" class="image-preview-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                                <img
                                    id="preview"
                                    src="#"
                                    class="image-preview"
                                    alt="Preview"
                                    style="display: none;"
                                >
                                <div class="image-preview-label" style="display: none;">Preview</div>
                            </div>
                            <p class="mt-2 text-muted small">Upload an image to see preview</p>
                        </div>
                    </div>
                </div>

                <hr class="my-4">

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('blogs.index') }}" class="btn btn-cancel-custom me-2">
                        <i class="fas fa-times me-1"></i> Cancel
                    </a>
                    <button type="submit" class="btn btn-add-custom">
                        <i class="fas fa-plus-circle me-1"></i> Create Blog
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('preview');
        const placeholder = document.getElementById('placeholder');
        const previewLabel = document.querySelector('.image-preview-label');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
                placeholder.style.display = 'none';
                previewLabel.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    // Add file name display
    document.getElementById('image').addEventListener('change', function() {
        const fileName = this.files[0]?.name;
        if (fileName) {
            const label = this.previousElementSibling;
            label.innerHTML = `<i class="fas fa-file-image"></i> ${fileName}`;
        }
    });

    // Simple text formatting for the content editor
    function formatText(command) {
        const textarea = document.getElementById('content');
        const start = textarea.selectionStart;
        const end = textarea.selectionEnd;
        const selectedText = textarea.value.substring(start, end);
        let replacement = '';

        switch(command) {
            case 'bold':
                replacement = `**${selectedText}**`;
                break;
            case 'italic':
                replacement = `*${selectedText}*`;
                break;
            case 'underline':
                replacement = `<u>${selectedText}</u>`;
                break;
            case 'h2':
                replacement = `\n## ${selectedText}\n`;
                break;
            case 'ul':
                replacement = `\n- ${selectedText.split('\n').join('\n- ')}\n`;
                break;
            case 'ol':
                const lines = selectedText.split('\n');
                replacement = '\n';
                for (let i = 0; i < lines.length; i++) {
                    replacement += `${i+1}. ${lines[i]}\n`;
                }
                break;
            case 'link':
                const url = prompt('Enter URL:', 'https://');
                if (url) {
                    replacement = `[${selectedText}](${url})`;
                } else {
                    return;
                }
                break;
        }

        textarea.value = textarea.value.substring(0, start) + replacement + textarea.value.substring(end);
        textarea.focus();
        textarea.selectionStart = start;
        textarea.selectionEnd = start + replacement.length;
    }
</script>
@endsection
