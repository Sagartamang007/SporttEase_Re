@extends('Frontend.layouts.Master')

@section('content')
<style>
    .con { color: white; background: #198754; }
    .con:hover { border: 1px solid #198754; color: #198754; background: transparent; }
    .futsal-info-card { background: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
    .futsal-img { width: 100%; max-height: 300px; object-fit: cover; border-radius: 10px; }
    .futsal-name { color: #198754; font-weight: bold; }
    .icon { font-size: 1.3rem; color: #198754; }
    .selected-time-section { display: flex; justify-content: center; gap: 20px; flex-wrap: wrap; text-align: center; }
    .selected-date, .selected-time { font-size: 1rem; text-align: center; }
    @media (max-width: 992px) { .futsal-info-card { padding: 15px; } }
    @media (max-width: 768px) { .selected-time-section { flex-direction: column; } .btn { width: 100%; } }
</style>

<div class="container-fluid">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="futsal-info-card text-center">
                    <img src="{{ asset($futsal->futsal_image) }}" alt="Futsal Image" class="futsal-img img-fluid">
                    <h2 class="futsal-name">{{ $futsal->futsal_name }}</h2>
                    <p><i class="icon fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $futsal->futsal_location }}</p>

                    <!-- MAP SECTION -->
                    <div class="mt-4">
                        <label for="map" class="form-label fw-bold">Location on Map</label>
                        <div id="map" style="height: 300px; border-radius: 8px;"></div>
                    </div>

                    <p class="mt-4"><i class="icon fas fa-info-circle"></i> <strong>Description:</strong> {{ $futsal->futsal_description }}</p>
                    <p><i class="icon fas fa-clock"></i> <strong>Opening Time:</strong> {{ $futsal->opening_time }}</p>
                    <p><i class="icon fas fa-clock"></i> <strong>Closing Time:</strong> {{ $futsal->closing_time }}</p>
                    <p><i class="icon fas fa-dollar-sign"></i> <strong>Price per Hour:</strong> NRs.{{ number_format($futsal->hourly_price, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container py-5">
    <h2 class="text-center mb-4" style="color: #198754;">Book Your Slot</h2>
    <form id="booking-form" method="POST" action="{{ route('pre.booking.store', $futsal->id) }}">
        @csrf

        <!-- Recurrence Type Dropdown -->
        <div class="mb-3">
            <label for="recurrence_type">Select Recurrence Type:</label>
            <select name="recurrence_type" id="recurrence_type" class="form-control" required>
                <option value="daily">Daily</option>
                <option value="weekly">Weekly</option>
                <option value="monthly">Monthly</option>
            </select>
        </div>

        <!-- Start Date Picker -->
        <div class="mb-3">
            <label for="calendar">Select a Start Date:</label>
            <div id="calendar"></div>
            <p>Selected Date: <span id="selected-date"></span></p>
            <input type="hidden" name="booking_date" id="booking-date-input" />
        </div>

        <!-- Time Slot Selection -->
        <div class="mb-3">
            <label>Select a Time Slot:</label>
            <div id="time-slots" class="selected-time-section"></div>
            <input type="hidden" name="start_time" id="selected-start-time-input" />
            <input type="hidden" name="end_time" id="selected-end-time-input" />
        </div>

        <button type="submit" id="continue-button" class="btn btn-success" disabled>Continue</button>
    </form>
</div>

<!-- External CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Pass bookings data to JavaScript -->
<script>
    const bookings = @json($bookings);
</script>

<!-- MAP SCRIPT -->
<script>
const savedLat = {{ $futsal->latitude ?? 27.7172 }};
const savedLng = {{ $futsal->longitude ?? 85.3240 }};

const map = L.map('map').setView([savedLat, savedLng], 13);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
}).addTo(map);

L.marker([savedLat, savedLng]).addTo(map)
    .bindPopup("{{ $futsal->futsal_name }}")
    .openPopup();
</script>

<!-- BOOKING SCRIPT -->
<script>
const calendar = document.getElementById("calendar");
const selectedDateText = document.getElementById("selected-date");
const bookingDateInput = document.getElementById("booking-date-input");
const continueButton = document.getElementById("continue-button");
const timeSlotsContainer = document.getElementById('time-slots');
const startTimeHidden = document.getElementById('selected-start-time-input');
const endTimeHidden = document.getElementById('selected-end-time-input');
const recurrenceTypeSelect = document.getElementById("recurrence_type");

let selectedTimeSlot = false;
let recurrenceCount = 0;

const openTime = "{{ \Carbon\Carbon::parse($futsal->opening_time)->format('H:i') }}";
const closeTime = "{{ \Carbon\Carbon::parse($futsal->closing_time)->format('H:i') }}";

flatpickr(calendar, {
    inline: true,
    minDate: "today",
    dateFormat: "Y-m-d",
    onChange: function(selectedDates, dateStr) {
        selectedDateText.textContent = dateStr;
        bookingDateInput.value = dateStr;
        selectedTimeSlot = false;
        startTimeHidden.value = '';
        endTimeHidden.value = '';
        document.querySelectorAll('#time-slots .btn').forEach(b => b.classList.remove("active"));
        generateAvailableTimeSlots(dateStr);
        toggleContinueButton();
    }
});

recurrenceTypeSelect.addEventListener('change', function() {
    const selectedType = recurrenceTypeSelect.value;
    if (selectedType === "daily") {
        recurrenceCount = 1;
    } else if (selectedType === "weekly") {
        recurrenceCount = 7;
    } else if (selectedType === "monthly") {
        recurrenceCount = 30;
    }

    toggleContinueButton();
});

function generateAvailableTimeSlots(dateStr) {
    timeSlotsContainer.innerHTML = "";

    const slots = generateTimeSlots(openTime, closeTime);
    const bookedSlots = bookings.filter(b => b.date === dateStr);

    slots.forEach(slot => {
        const isBooked = bookedSlots.some(booked => {
            const bookedStart = booked.start_time.slice(0, 5);
            const bookedEnd = booked.end_time.slice(0, 5);
            return slot.start >= bookedStart && slot.start < bookedEnd;
        });

        const btn = document.createElement("button");
        btn.type = "button";
        btn.classList.add("btn", "m-1");

        if (isBooked) {
            btn.classList.add("btn-secondary");
            btn.disabled = true;
        } else {
            btn.classList.add("btn-outline-success");
            btn.addEventListener("click", () => {
                document.querySelectorAll('#time-slots .btn').forEach(b => b.classList.remove("active"));
                btn.classList.add("active");

                startTimeHidden.value = slot.start;
                endTimeHidden.value = slot.end;

                selectedTimeSlot = true;
                toggleContinueButton();
            });
        }

        btn.textContent = `${slot.start} - ${slot.end}`;
        timeSlotsContainer.appendChild(btn);
    });

    if (timeSlotsContainer.innerHTML.trim() === "") {
        timeSlotsContainer.innerHTML = "<p class='text-danger'>No available time slots for this date.</p>";
    }
}

function generateTimeSlots(start, end) {
    const slots = [];
    let current = new Date();
    const [startHour, startMinute] = start.split(":").map(Number);
    const [endHour, endMinute] = end.split(":").map(Number);

    current.setHours(startHour, startMinute, 0, 0);
    const endTime = new Date();
    endTime.setHours(endHour, endMinute, 0, 0);

    while (current < endTime) {
        const slotStart = current.toTimeString().slice(0,5);
        const next = new Date(current.getTime() + 60 * 60 * 1000);

        if (next > endTime) break;

        const slotEnd = next.toTimeString().slice(0,5);
        slots.push({ start: slotStart, end: slotEnd });

        current = next;
    }

    return slots;
}

function toggleContinueButton() {
    continueButton.disabled = !(bookingDateInput.value && selectedTimeSlot);
}
</script>
@endsection
