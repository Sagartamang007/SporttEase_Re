
  document.addEventListener("DOMContentLoaded", function () {
    var swiper = new Swiper(".mySwiper", {
        slidesPerView: 1,
        spaceBetween: 20,
        loop: true,
        navigation: {
            nextEl: ".custom-swiper-button-next", // Link to your custom class
            prevEl: ".custom-swiper-button-prev", // Link to your custom class
        },
        breakpoints: {
            992: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 10,
            },
            576: {
                slidesPerView: 1,
                spaceBetween: 10,
            },
        },
    });
  });

// //   booking slot script
//       document.addEventListener('DOMContentLoaded', function () {
//           // Get all time slot buttons except the booked ones
//           const slots = document.querySelectorAll('.slot:not(.booked)');
//           let selectedSlot = '';

//           // Add click event listener to each available slot
//           slots.forEach(slot => {
//               slot.addEventListener('click', function () {
//                   selectedSlot = this.getAttribute('data-time'); // Get slot time
//                   document.getElementById('selectedSlot').textContent = selectedSlot; // Show slot in modal

//                   // Initialize and show the modal
//                   const bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
//                   bookingModal.show();
//               });
//           });

//           // Handle booking confirmation
//           document.getElementById('confirmBooking').addEventListener('click', function () {
//               alert(`Slot "${selectedSlot}" has been booked successfully!`);
//               // Optionally, send a backend call here to save the booking
//           });
//       });




document.addEventListener('DOMContentLoaded', function () {
    // Helper function to update the displayed selected date and time
    function updateSelectedSlot() {
        const date = datePicker.value || "-";
        const startTime = `${startHour.value}:${startMinute.value} ${startAmpm.value}`;
        const endTime = `${endHour.value}:${endMinute.value} ${endAmpm.value}`;

        selectedDateElement.textContent = date;
        selectedTimeElement.textContent =
            date === "-" ? "Start Time: - | End Time: -" : `Start Time: ${startTime} | End Time: ${endTime}`;

        // Update hidden inputs
        startTimeInput.value = date !== "-" ? startTime : "";
        endTimeInput.value = date !== "-" ? endTime : "";
    }

    // Reset form to initial state
    function resetForm() {
        datePicker.value = "";
        [startHour, startMinute, startAmpm, endHour, endMinute, endAmpm].forEach(el => el.value = "");
        updateSelectedSlot();
    }

    // DOM Elements
    const datePicker = document.getElementById("date-picker");
    const [startHour, startMinute, startAmpm] = ["start-hour", "start-minute", "start-ampm"].map(id => document.getElementById(id));
    const [endHour, endMinute, endAmpm] = ["end-hour", "end-minute", "end-ampm"].map(id => document.getElementById(id));
    const selectedDateElement = document.getElementById("selectedDate");
    const selectedTimeElement = document.getElementById("selectedTime");
    const startTimeInput = document.getElementById("start-time-input");
    const endTimeInput = document.getElementById("end-time-input");
    const cancelButton = document.getElementById("cancelButton");

    // Initialize Flatpickr
    if (datePicker) {
        flatpickr(datePicker, {
            dateFormat: "Y-m-d",
            minDate: "today",
            onChange: updateSelectedSlot,
        });
    }

    // Add event listeners for time dropdowns
    [startHour, startMinute, startAmpm, endHour, endMinute, endAmpm].forEach(el => {
        if (el) el.addEventListener("change", updateSelectedSlot);
    });

    // Reset button functionality
    if (cancelButton) cancelButton.addEventListener("click", resetForm);
});



