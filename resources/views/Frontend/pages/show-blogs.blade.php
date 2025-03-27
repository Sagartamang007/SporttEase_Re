@extends('Frontend.layouts.Master')

@section('content')
    <!-- Hero Header -->
    <div class="blog-hero py-5 position-relative" style="margin-top: 3rem;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-md-11 col-12 text-center">
                    <h1 class="display-4 fw-bold text-gradient mb-2">{{ $blog->title }}</h1>
                    <div class="blog-meta d-flex justify-content-center align-items-center flex-wrap gap-3 mt-3">
                        <span class="blog-date"><i class="bi bi-calendar3 me-1"></i>
                            {{ $blog->created_at->format('M d, Y') }}</span>
                        @if ($blog->category)
                            <span class="blog-category"><i class="bi bi-bookmark me-1"></i> {{ $blog->category }}</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main class="container py-5">
        <div class="row g-4">
            <!-- Main Blog Content -->
            <div class="col-lg-8">
                <article class="card border-0 shadow-sm overflow-hidden blog-card">
                    @if ($blog->image)
                        <div class="blog-image-wrapper">
                            <img src="{{ asset('storage/' . $blog->image) }}" class="card-img-top blog-image"
                                alt="{{ $blog->title }}">
                        </div>
                    @endif
                    <div class="card-body p-4 p-lg-5">
                        <div class="blog-content">
                            {!! $blog->content !!}
                        </div>

                        <!-- Social Share -->
                        <!-- Social Share -->
                        <div class="blog-share mt-5 pt-4 border-top">
                            <h5 class="mb-3">Share this article</h5>
                            <div class="d-flex gap-2">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                    target="_blank" class="btn btn-sm btn-outline-primary rounded-circle social-btn">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}"
                                    target="_blank" class="btn btn-sm btn-outline-info rounded-circle social-btn">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode(url()->current()) }}"
                                    target="_blank" class="btn btn-sm btn-outline-success rounded-circle social-btn">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                    target="_blank" class="btn btn-sm btn-outline-secondary rounded-circle social-btn">
                                    <i class="bi bi-linkedin"></i>
                                </a>

                                <!-- Copy Link Button -->
                                <button onclick="copyBlogLink()"
                                    class="btn btn-sm btn-outline-dark rounded-circle social-btn">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>

                            <!-- Copy Confirmation Message -->
                            <p id="copyMessage" class="text-success mt-2" style="display: none;">Link copied to clipboard!
                            </p>
                        </div>

                    </div>
                </article>
            </div>

            <!-- Sidebar (Related Blogs) -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 4rem; z-index: 10;">
                    <!-- Related Blogs -->
                    <div class="card border-0 shadow-sm mb-4 sidebar-card">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
                            <h4 class="sidebar-title position-relative">Related Articles</h4>
                        </div>
                        <div class="card-body p-4">
                            @if (count($relatedBlogs) > 0)
                                <ul class="list-unstyled related-blogs-list">
                                    @foreach ($relatedBlogs as $related)
                                        <li class="related-blog-item mb-3 pb-3">
                                            <a href="{{ route('blogs.show', $related->id) }}"
                                                class="related-blog-link d-flex align-items-center">
                                                @if ($related->image)
                                                    <div class="related-blog-image me-3">
                                                        <img src="{{ asset('storage/' . $related->image) }}"
                                                            alt="{{ $related->title }}" class="img-fluid rounded">
                                                    </div>
                                                @endif
                                                <div class="related-blog-info">
                                                    <h6 class="mb-1">{{ $related->title }}</h6>
                                                    <small
                                                        class="text-muted">{{ $related->created_at->format('M d, Y') }}</small>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-muted">No related articles found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
        /* General Styles */
        :root {
            --primary-color: #198754;
            --primary-hover: #157347;
            --accent-color: rgba(240, 46, 170, 0.8);
            --text-color: #333;
            --light-bg: #f8f9fa;
            --border-radius: 0.5rem;
            --box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }

        body {
            color: var(--text-color);
            line-height: 1.7;
        }

        /* Hero Section */
        .blog-hero {
            background-color: var(--light-bg);
            position: relative;
            overflow: hidden;
        }

        .blog-hero::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 10px;
            background: linear-gradient(135deg, transparent 25%, var(--light-bg) 25%, var(--light-bg) 50%, transparent 50%, transparent 75%, var(--light-bg) 75%);
            background-size: 20px 20px;
        }

        .text-gradient {
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }

        .blog-meta {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .blog-meta span {
            padding: 0.25rem 0.75rem;
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 50px;
        }

        /* Blog Content */
        .blog-card {
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
        }

        .blog-image-wrapper {
            overflow: hidden;
        }

        .blog-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            transition: var(--transition);
        }

        .blog-card:hover .blog-image {
            transform: scale(1.03);
        }

        .blog-content {
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .blog-content p {
            margin-bottom: 1.5rem;
        }

        .blog-content h2,
        .blog-content h3 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .blog-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 1.5rem 0;
        }

        .blog-content blockquote {
            border-left: 4px solid var(--primary-color);
            padding-left: 1rem;
            font-style: italic;
            margin: 1.5rem 0;
        }

        /* Social Share */
        .social-btn {
            width: 38px;
            height: 38px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: var(--transition);
        }

        .social-btn:hover {
            transform: translateY(-3px);
        }

        /* Sidebar */
        .sidebar-card {
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition);
        }

        .sidebar-title {
            color: var(--primary-color);
            font-weight: 600;
            padding-bottom: 0.5rem;
            position: relative;
        }

        .sidebar-title::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            border-radius: 3px;
        }

        .related-blogs-list {
            margin: 0;
            padding: 0;
        }

        .related-blog-item {
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            transition: var(--transition);
        }

        .related-blog-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 0;
        }

        .related-blog-link {
            text-decoration: none;
            color: var(--text-color);
            transition: var(--transition);
        }

        .related-blog-link:hover {
            color: var(--primary-color);
        }

        .related-blog-link:hover h6 {
            color: var(--primary-color);
        }

        .related-blog-image {
            width: 60px;
            height: 60px;
            flex-shrink: 0;
            overflow: hidden;
            border-radius: 0.25rem;
        }

        .related-blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Form Controls */
        .form-control {
            padding: 0.75rem 1rem;
            border-color: rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
            border-color: var(--primary-color);
        }

        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .sticky-top {
                position: relative;
                top: 0 !important;
            }

            .blog-content {
                font-size: 1rem;
            }
        }

        @media (max-width: 767.98px) {
            .blog-hero {
                padding-top: 3rem;
                padding-bottom: 3rem;
            }

            .display-4 {
                font-size: 2rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .blog-image {
                max-height: 300px;
            }
        }

        @media (max-width: 575.98px) {
            .blog-hero {
                padding-top: 2rem;
                padding-bottom: 2rem;
            }

            .display-4 {
                font-size: 1.75rem;
            }

            .blog-meta {
                font-size: 0.8rem;
            }

            .card-body {
                padding: 1.25rem;
            }

            .blog-content {
                font-size: 0.95rem;
            }

            .related-blog-image {
                width: 50px;
                height: 50px;
            }
        }
    </style>
    <script>
        function copyBlogLink() {
            // Get the current blog URL
            const blogUrl = "{{ url()->current() }}";

            // Create a temporary input element
            const tempInput = document.createElement("input");
            tempInput.value = blogUrl;
            document.body.appendChild(tempInput);

            // Select and copy the text
            tempInput.select();
            document.execCommand("copy");

            // Remove the temporary input
            document.body.removeChild(tempInput);

            // Show confirmation message
            const copyMessage = document.getElementById("copyMessage");
            copyMessage.style.display = "block";

            // Hide message after 2 seconds
            setTimeout(() => {
                copyMessage.style.display = "none";
            }, 2000);
        }
    </script>

@endsection
