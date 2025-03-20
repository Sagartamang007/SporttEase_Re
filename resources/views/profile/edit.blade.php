@extends('FrontEnd.layouts.master')
@section('content')

<style>
/* Dark Mode Background */
.dark {
    background-color: #1a202c;
    color: #e2e8f0;
}

/* Container styles */
.py-12 {
    padding-top: 3rem;
    padding-bottom: 3rem;
}

.max-w-7xl {
    margin: 0 auto;
    max-width: 55rem; /* Compact layout */
}

.space-y-6 > * + * {
    margin-top: 1.5rem;
}

/* Card styles */
.card {
    margin-top: 4rem;
    padding: 2rem;
    background-color: #ffffff;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: box-shadow 0.3s ease;
}

.card:hover {
    /* transform: translateY(-5px); */
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.dark .card {
    background-color: #2d3748;
}

/* Form container */
.max-w-xl {
    max-width: 28rem;
    margin: 0 auto;
}

/* Input fields */
input[type="text"],
input[type="email"],
input[type="password"],
textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    margin-top: 0.5rem;
    margin-bottom: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    background-color: #f8fafc;
    font-size: 1rem;
    transition: all 0.3s ease;
}

input:focus,
textarea:focus {
    outline: none;
    border-color: #198754;
    box-shadow: 0 0 0 3px rgba(25, 135, 84, 0.3);
}

.dark input[type="text"],
.dark input[type="email"],
.dark input[type="password"],
.dark textarea {
    background-color: #2d3748;
    border: 1px solid #4a5568;
    color: #e2e8f0;
}

/* Buttons */
button {
    display: inline-block;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    font-weight: 600;
    color: #ffffff;
    background-color: #198754;
    border: none;
    border-radius: 0.375rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

button:hover {
    background-color: #146c43;
    transform: scale(1.03);
}

button:active {
    background-color: #0f5132;
    transform: scale(1);
}

.dark button {
    background-color: #198754;
}

.dark button:hover {
    background-color: #146c43;
}

/* Responsive styles */
@media (max-width: 640px) {
    .card {
        padding: 1.5rem;
    }

    .max-w-7xl {
        padding: 1rem;
    }
}
</style>

<div class="py-12">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Profile Information Card -->
        <div class="card">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Password Update Card -->
        <div class="card">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>
</div>

@endsection
