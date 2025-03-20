@extends('Frontend.layouts.Master')
@section('content')
<div class="text-center py-4 bg-light position-relative" style="margin-top: 3rem;">
    <h1 class="display-4" style="color: #198754;font-weight:600">Blogs</h1>
</div>

<main class="container my-5" style="margin-top: 30px;">
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
        <!-- Blog Card 1 -->
        <div class="col">
            <div class="card h-100 blog-card">
                <img src="{{asset('blg4.jpg')}}" class="card-img-top" alt="Blog 1 Image">
                <div class="card-body">
                    <h5 class="card-title">Blog Title 1</h5>
                    <p class="text-muted">Published on: Jan 1, 2025</p>
                    <p class="card-text">This is a brief description of the blog content. It gives users an idea of what the blog is about...</p>
                    <a href="#" class="nums-but">Read More</a>
                </div>
            </div>
        </div>

        <!-- Blog Card 2 -->
        <div class="col">
            <div class="card h-100 blog-card">
                <img src="{{asset('blg3.jpg')}}" class="card-img-top" alt="Blog 2 Image">
                <div class="card-body">
                    <h5 class="card-title">Blog Title 2</h5>
                    <p class="text-muted">Published on: Jan 2, 2025</p>
                    <p class="card-text">Another blog description goes here. This preview should be concise and engaging...</p>
                    <a href="#" class="nums-but">Read More</a>
                </div>
            </div>
        </div>

        <!-- Blog Card 3 -->
        <div class="col">
            <div class="card h-100 blog-card">
                <img src="{{asset('blg2.jpg')}}" class="card-img-top" alt="Blog 3 Image">
                <div class="card-body">
                    <h5 class="card-title">Blog Title 3</h5>
                    <p class="text-muted">Published on: Jan 3, 2025</p>
                    <p class="card-text">This is a sample content snippet for the third blog. Add more details as needed...</p>
                    <a href="#" class="nums-but">Read More</a>
                </div>
            </div>
        </div>

        <!-- Blog Card 4 -->
        <div class="col">
            <div class="card h-100 blog-card">
                <img src="{{asset('blg1.jpg')}}" class="card-img-top" alt="Blog 4 Image">
                <div class="card-body">
                    <h5 class="card-title">Blog Title 4</h5>
                    <p class="text-muted">Published on: Jan 4, 2025</p>
                    <p class="card-text">Preview of the fourth blog content. Make it appealing to grab attention...</p>
                    <a href="#" class="nums-but">Read More</a>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

<style>
    .blog-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .blog-card:hover {
        transform: translateY(-5px); /* Move card slightly up */
        box-shadow: rgba(240, 46, 170, 0.4) 5px 5px, rgba(240, 46, 170, 0.3) 10px 10px, rgba(240, 46, 170, 0.2) 15px 15px, rgba(240, 46, 170, 0.1) 20px 20px, rgba(240, 46, 170, 0.05) 25px 25px;    }
</style>
    }
</style>
