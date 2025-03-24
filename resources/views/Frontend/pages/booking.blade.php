@extends('Frontend.layouts.Master')

@section('content')
    <style>
        .con {
            color: white;
            background: #198754;
        }

        .con:hover {
            border: 1px solid #198754;
            color: #198754;
            background: transparent;
        }

        .futsal-info-card {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .futsal-img {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }

        .futsal-name {
            color: #198754;
            font-weight: bold;
        }

        .icon {
            font-size: 1.3rem;
            color: #198754;
        }

        .selected-time-section {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            text-align: center;
        }

        .selected-date, .selected-time {
            font-size: 1rem;
            text-align: center;
        }

        /* Responsive Styling */
        @media (max-width: 992px) {
            .futsal-info-card {
                padding: 15px;
            }
        }

        @media (max-width: 768px) {
            .selected-time-section {
                flex-direction: column;
            }

            .btn {
                width: 100%;
            }
        }
    </style>

    <div class="container-fluid">

        <!-- Futsal Information Section -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="futsal-info-card text-center">
                        <div class="rounded-image-section mb-3">
                            <img src="{{ asset($futsal->futsal_image) }}" alt="Futsal Image" class="futsal-img img-fluid">
                        </div>

                        <h2 class="futsal-name">{{ $futsal->futsal_name }}</h2>

                        <p class="mt-3"><i class="icon fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $futsal->futsal_location }}</p>
                        <p><i class="icon fas fa-info-circle"></i> <strong>Description:</strong> {{ $futsal->futsal_description }}</p>
                        <p><i class="icon fas fa-clock"></i> <strong>Opening Time:</strong> {{ $futsal->opening_time }}</p>
                        <p><i class="icon fas fa-clock"></i> <strong>Closing Time:</strong> {{ $futsal->closing_time }}</p>
                        <p><i class="icon fas fa-dollar-sign"></i> <strong>Price per Hour:</strong> ${{ number_format($futsal->hourly_price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Booking Section -->
    <div class="container py-5">
        <h2 class="text-center mb-4" style="color: #198754;">Book Your Slot</h2>
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6 col-md-8 col-sm-10 col-12">
                    <label for="date-picker" class="fw-bold">Select Date</label>
                    <input type="text" id="date-picker" name="date" class="form-control" placeholder="Select Date" required />
                </div>
            </div>

            <!-- Time Selection -->
            <div class="row justify-content-center mb-4">
                <div class="col-lg-6 col-md-8 col-sm-10 col-12">
                    <label for="time-range" class="fw-bold">Select Time Range</label>
                    <input type="text" id="time-range" name="time_range" class="form-control" placeholder="Select Time" required />
                </div>
            </div>

            <!-- Display Selected Date and Time -->
            <div class="selected-time-section text-center mt-4">
                <div class="selected-date">
                    <strong>Selected Date:</strong>
                    <p id="selectedDate" class="fw-bold">-</p>
                </div>
                <div class="selected-time">
                    <strong>Selected Time:</strong>
                    <p id="selectedTime" class="fw-bold">-</p>
                </div>
            </div>

            <input type="hidden" name="user_name" value="{{ Auth::user()->name }}" />
            <input type="hidden" id="start-time-input" name="start_time" />
            <input type="hidden" id="end-time-input" name="end_time" />

            <div class="d-flex flex-column flex-md-row justify-content-center mt-3 gap-2">
                <button id="cancelButton" type="reset" class="btn btn-secondary">Cancel</button>
                <button type="submit" id="confirmButton" class="btn con">Confirm</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr('#date-picker', {
                dateFormat: 'Y-m-d',
                minDate: 'today',
            });

            flatpickr('#time-range', {
                enableTime: true,
                noCalendar: true,
                dateFormat: "h:i K",
            });

            const selectedDateElement = document.getElementById('selectedDate');
            const selectedTimeElement = document.getElementById('selectedTime');

            function updateSelectedDateTime() {
                const selectedDate = document.getElementById('date-picker').value;
                const selectedTime = document.getElementById('time-range').value;

                if (!selectedDate || !selectedTime) return;

                selectedDateElement.innerHTML = selectedDate;
                selectedTimeElement.innerHTML = selectedTime;
            }

            document.getElementById('date-picker').addEventListener('change', updateSelectedDateTime);
            document.getElementById('time-range').addEventListener('change', updateSelectedDateTime);
        });
    </script>
@endsection
