@extends('Frontend.layouts.Master')

@section('content')
<style>
    .success-container {
        max-width: 600px;
        margin: 80px auto;
        padding: 40px;
        background-color: #f8f9fa;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .success-icon {
        font-size: 60px;
        color: #198754;
        margin-bottom: 20px;
    }
    .btn-home {
        margin-top: 20px;
    }
</style>

<div class="container">
    <div class="success-container">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h2 class="text-success">Booking Confirmed!</h2>
        <p>Thank you for your payment. Your futsal slot has been successfully booked.</p>
        <p>You will receive a confirmation message soon.</p>
        <a href="{{ route('home') }}" class="btn btn-success btn-home">Go to Home</a>
    </div>
</div>
@endsection
