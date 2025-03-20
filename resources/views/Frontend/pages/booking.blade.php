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
        }

        .selected-time-section {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .selected-date, .selected-time {
            font-size: 1.1rem;
        }
    </style>

    <div class="container-fluid">
        <!-- Green Cover Section -->
        <div class="cover-section">
            <img src="{{ asset($futsal->cover_image) }}" alt="Cover Image" class="img-fluid w-100">
        </div>

        <!-- Rounded Image Section Below the Cover Image -->
        <div class="rounded-image-section text-center mt-4">
            <img src="{{ asset($futsal->image) }}" alt="Rounded Image" class="rounded-circle img-fluid" style="max-width: 200px;">
        </div>

        <!-- Description Section -->
        <div class="description-section text-center mt-4">
            <p>{{ $futsal->description }}</p>
        </div>
    </div>

    <div class="container py-5">
        <h2 class="text-center mb-4" style="color: #198754;">Book Your Slot</h2>
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <label for="date-picker" style="font-weight: bold;">Select Date</label>
                    <input type="text" id="date-picker" name="date" class="form-control" placeholder="Select Date" required />
                </div>
            </div>

            <!-- Combined Start Time and End Time Section -->
            <div class="row justify-content-center mb-4">
                <div class="col-12 col-md-6 mb-3 mb-md-0">
                    <div class="d-flex" style="justify-content: center;">
                        <!-- Start Time -->
                        <div class="me-2">
                            <label for="start-time" style="font-weight: bold;">Select Start Time</label>

                            <select id="start-hour" class="form-control mb-2">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <select id="start-minute" class="form-control mb-2">
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                            <select id="start-ampm" class="form-control">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>

                        <!-- End Time -->
                        <div>
                            <label for="end-time" style="font-weight: bold;">Select End Time</label>
                            <select id="end-hour" class="form-control mb-2">
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <select id="end-minute" class="form-control mb-2">
                                <option value="00">00</option>
                                <option value="15">15</option>
                                <option value="30">30</option>
                                <option value="45">45</option>
                            </select>
                            <select id="end-ampm" class="form-control">
                                <option value="AM">AM</option>
                                <option value="PM">PM</option>
                            </select>
                        </div>
                    </div>
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
                    <p id="selectedTime" class="fw-bold">Start Time: - | End Time: -</p>
                </div>
            </div>

            <!-- Hidden field for the logged-in user's name -->
            <input type="hidden" name="user_name" value="{{ Auth::user()->name }}" />
            <!-- Hidden fields for start and end times -->
            <input type="hidden" id="start-time-input" name="start_time" />
            <input type="hidden" id="end-time-input" name="end_time" />

            <div class="d-flex justify-content-center mt-3">
                <button id="cancelButton" class="btn btn-secondary me-2">Cancel</button>
                <button type="submit" id="confirmButton" class="btn con">Confirm</button>
            </div>
        </form>
    </div>

    <script>
        // Initialize flatpickr for date picker
        document.addEventListener('DOMContentLoaded', function () {
            flatpickr('#date-picker', {
                dateFormat: 'Y-m-d', // Format: YYYY-MM-DD
                minDate: 'today',    // Prevent selecting past dates
            });

            const selectedDateElement = document.getElementById('selectedDate');
            const selectedTimeElement = document.getElementById('selectedTime');
            const cancelButton = document.getElementById('cancelButton');
            const startTimeInput = document.getElementById('start-time-input');
            const endTimeInput = document.getElementById('end-time-input');

            // Update selected date and time on change
            function updateSelectedDateTime() {
                const selectedDate = document.getElementById('date-picker').value;
                const startHour = document.getElementById('start-hour').value;
                const startMinute = document.getElementById('start-minute').value;
                const startAmpm = document.getElementById('start-ampm').value;
                const endHour = document.getElementById('end-hour').value;
                const endMinute = document.getElementById('end-minute').value;
                const endAmpm = document.getElementById('end-ampm').value;

                // Ensure all fields are filled
                if (!selectedDate || !startHour || !startMinute || !startAmpm || !endHour || !endMinute || !endAmpm) {
                    return;
                }

                // Format the time and update the display
                const startTime = `${startHour}:${startMinute} ${startAmpm}`;
                const endTime = `${endHour}:${endMinute} ${endAmpm}`;

                // Update the elements for selected date and time
                selectedDateElement.innerHTML = selectedDate;
                selectedTimeElement.innerHTML = `Start Time: ${startTime} | End Time: ${endTime}`;

                // Set the hidden input fields for start and end time
                startTimeInput.value = startTime;
                endTimeInput.value = endTime;
            }

            // Event listeners for the time and date selections
            document.getElementById('date-picker').addEventListener('change', updateSelectedDateTime);
            document.getElementById('start-hour').addEventListener('change', updateSelectedDateTime);
            document.getElementById('start-minute').addEventListener('change', updateSelectedDateTime);
            document.getElementById('start-ampm').addEventListener('change', updateSelectedDateTime);
            document.getElementById('end-hour').addEventListener('change', updateSelectedDateTime);
            document.getElementById('end-minute').addEventListener('change', updateSelectedDateTime);
            document.getElementById('end-ampm').addEventListener('change', updateSelectedDateTime);

            // Optional: Reset form on clicking cancel
            cancelButton.addEventListener('click', function () {
                document.getElementById('date-picker').value = '';
                document.getElementById('start-hour').value = '';
                document.getElementById('start-minute').value = '';
                document.getElementById('start-ampm').value = '';
                document.getElementById('end-hour').value = '';
                document.getElementById('end-minute').value = '';
                document.getElementById('end-ampm').value = '';
                selectedDateElement.innerHTML = '-';
                selectedTimeElement.innerHTML = 'Start Time: - | End Time: -';
                startTimeInput.value = '';
                endTimeInput.value = '';
            });
        });
    </script>
@endsection
