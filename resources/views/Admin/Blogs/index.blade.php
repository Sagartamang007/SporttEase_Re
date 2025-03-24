@extends('admin.layouts.app')

@section('content')
<div class="container-fluid py-4">

    <!-- SUCCESS MESSAGE (Styled to the Right) -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-4">
        <div class="col d-flex justify-content-between align-items-center">
            <h2 class="fw-bold text-dark mb-0">
                <i class="fas fa-newspaper text-primary me-2"></i>Manage Blogs
            </h2>
            <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary rounded-pill shadow-sm">
                <i class="fas fa-plus me-1"></i> Add New Blog
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom border-light py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-bold text-primary">
                    <i class="fas fa-list me-2"></i>Blog List
                </h5>
                <span class="badge bg-primary rounded-pill">{{ count($blogs) }} Blogs</span>
            </div>
        </div>
        <div class="card-body p-0">
            @if(count($blogs) > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="py-3 ps-4">Title</th>
                                <th class="py-3 text-center">Image</th>
                                <th class="py-3 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                            <tr>
                                <td class="ps-4 py-3 fw-medium">{{ $blog->title }}</td>
                                <td class="text-center">
                                    @if($blog->image)
                                        <img src="{{ asset('storage/' . $blog->image) }}" class="blog-image rounded" alt="{{ $blog->title }}">
                                    @else
                                        <span class="badge bg-secondary">No Image</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" style="gap:15px;">
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <form id="delete-form-{{ $blog->id }}" action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger delete-btn" data-id="{{ $blog->id }}">
                                                <i class="fas fa-trash-alt me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5">
                    <div class="empty-state-icon mb-4">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h4 class="fw-bold">No blogs found</h4>
                    <p class="text-muted mb-4">Get started by creating your first blog post</p>
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary rounded-pill px-4 py-2">
                        <i class="fas fa-plus me-2"></i> Create New Blog
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- CUSTOM STYLES -->
<style>
    /* Success message styling */
    .custom-alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        animation: fadeInRight 0.5s ease-in-out;
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    /* Enhanced styling */
    .card {
        border-radius: 10px;
        overflow: hidden;
    }

    .table th {
        font-weight: 600;
        color: #495057;
        border-top: none;
    }

    .table td {
        border-color: #f1f1f1;
    }

    .blog-image {
        height: 60px;
        width: 80px;
        object-fit: cover;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: transform 0.2s;
    }

    .blog-image:hover {
        transform: scale(1.05);
    }

    .btn-outline-primary, .btn-outline-danger {
        border-width: 1.5px;
        font-weight: 500;
    }

    .btn-outline-primary:hover, .btn-outline-danger:hover {
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #6c757d;
        background-color: #f8f9fa;
        width: 100px;
        height: 100px;
        line-height: 100px;
        border-radius: 50%;
        margin: 0 auto;
        opacity: 0.7;
    }

    .fw-medium {
        font-weight: 500;
    }

    /* Hover effect for rows */
    .table-hover tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.05);
    }
</style>

<!-- SweetAlert for Delete Confirmation -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function () {
                let blogId = this.getAttribute('data-id');
                Swal.fire({
                    title: "Are you sure?",
                    text: "This action cannot be undone!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + blogId).submit();
                    }
                });
            });
        });
    });
</script>

@endsection
