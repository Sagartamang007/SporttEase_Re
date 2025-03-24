<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | SportEase</title>

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Admin CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}"> --}}
</head>
<body>
    @include('admin.layouts.sidebar')

    <div class="main-content">
        @include('admin.layouts.navbar')

        <div class="content container">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap Bundle JS (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
