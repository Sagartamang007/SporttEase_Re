@extends('Frontend.layouts.Master')

@section('content')
<form class="container text-center mt-5"    id="khalti-payment-form">
    @csrf
    <h2>Confirm Payment</h2>
    <p><strong>Date:</strong> {{ $booking->date }}</p>
    <p><strong>Time:</strong> {{ $booking->start_time }} - {{ $booking->end_time }}</p>
    <p><strong>Total Amount:</strong> NRs. {{ $booking->futsal_Court->hourly_price ?? 'N/A' }}</p>

    <button type="submit" class="btn btn-success btn-lg btn-block" id="khalti-btn">Pay with Khalti</button>
</form>
<script>
    document.getElementById('khalti-payment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        const form = this;
        const formData = new FormData(form);
        const submitBtn = document.getElementById('khalti-btn');
        submitBtn.disabled = true;
        submitBtn.innerText = "Redirecting...";

        fetch("{{ route('khalti.purchase',[$booking->id]) }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
            },
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                if (data.khalti_url) {
                    window.location.href = data.khalti_url;
                } else {
                    alert("Error initiating payment. Please try again.");
                    submitBtn.disabled = false;
                    submitBtn.innerText = "Pay with Khalti";
                }
            })
            .catch(error => {
                console.error('Payment initiation failed:', error);
                alert("Something went wrong. Please try again later.");
                submitBtn.disabled = false;
                submitBtn.innerText = "Pay with Khalti";
            });
    });
</script>
@endsection
