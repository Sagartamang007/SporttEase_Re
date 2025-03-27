@extends('Frontend.layouts.Master')

@section('content')
<div class="container py-4" style="margin-top: 4rem;">
    <div class="card futsal-details shadow-lg border-0 rounded-lg overflow-hidden">
        <div class="card-header text-center bg-success text-white py-3">
            <h2 class="mb-0 fw-bold">{{ $futsal->futsal_name }}</h2>
        </div>
        <div class="card-body p-0" style="margin-top: 1rem;">
            <div class="row g-0">
                <div class="col-md-6">
                    <div class="futsal-image h-100">
                        <img src="{{ asset($futsal->futsal_image) }}" alt="Futsal Image" class="img-fluid w-100 h-100 object-fit-cover">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4">
                        <div class="mb-4">
                            <h4 class="text-success mb-3">Facility Details</h4>
                            <div class="row mb-2">
                                <div class="col-lg-4 fw-bold">Description:</div>
                                <div class="col-lg-8">{{ $futsal->futsal_description }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-4 fw-bold">Location:</div>
                                <div class="col-lg-8">{{ $futsal->futsal_location }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-4 fw-bold">Courts:</div>
                                <div class="col-lg-8">{{ $futsal->num_court }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-4 fw-bold">Hours:</div>
                                <div class="col-lg-8">{{ $futsal->opening_time }} - {{ $futsal->closing_time }}</div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg-4 fw-bold">Price:</div>
                                <div class="col-lg-8 fs-5 text-success">${{ number_format($futsal->hourly_price, 2) }} / hour</div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center mt-4">
                            <a href="{{ route('booking', $futsal->id) }}" class="btn btn-success px-4 py-2 fw-bold">Book Now</a>
                            <a href="{{route('home')}}" class="btn btn-outline-secondary px-4 py-2">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
