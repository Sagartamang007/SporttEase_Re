@extends('Frontend.layouts.Master')
@section('content')

<div class="text-center py-4 bg-light position-relative" style="margin-top: 3rem;">
    <h1 class="display-4" style="color: #198754; font-weight:600">Blogs</h1>
</div>

<main class="container my-5">
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @foreach ($blogs as $blog)
        <div class="col">
            <div class="card mb-3 blog-card">
                <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top blog-image" alt="{{ $blog->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ Str::words(strip_tags($blog->title), 20, '...') }}</h5>
                    <p class="card-text blog-description">{{ Str::words(strip_tags($blog->content), 20, '...') }}</p>
                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn custom-btn">Read More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</main>

<style>
    /* Blog description styling */
.blog-description {
    max-height: 60px; /* Prevents excessive height */
    overflow: hidden;
    text-overflow: ellipsis; /* Adds "..." if text overflows */
    white-space: nowrap;
}

    /* Blog card styling */
    .blog-card {
        background-color: white;
        color: black;
        transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
    }

    /* Hover effect */
    .blog-card:hover {
        transform: scale(1.05);
        box-shadow: rgba(240, 46, 170, 0.4) 5px 5px,
                    rgba(240, 46, 170, 0.3) 10px 10px,
                    rgba(240, 46, 170, 0.2) 15px 15px,
                    rgba(240, 46, 170, 0.1) 20px 20px,
                    rgba(240, 46, 170, 0.05) 25px 25px;
    }

    /* Uniform image size */
    .blog-image {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    /* Custom button styling */
    .custom-btn {
        background-color:rgb(0, 128, 0);
        color: white;
        border: none;
        transition: background-color 0.3s ease-in-out;
    }

    .custom-btn:hover {
        background-color:white;
        color:#198754;
        border:1px solid #198754;
    }
</style>

@endsection
