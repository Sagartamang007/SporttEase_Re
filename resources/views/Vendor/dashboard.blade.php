<x-app-layout>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Vendor Dashboard</h1>
        </div>

        <section class="section dashboard">
            <div class="row">
                <!-- Total Bookings -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Total Bookings</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $totalBookings }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Today's Bookings -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Today's Bookings</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $todayBookings }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- This Month's Bookings -->
                {{-- <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">This Month's Bookings</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-calendar"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>{{ $thisMonthBookings }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Canceled Bookings -->
                {{-- <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Canceled Bookings</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-x-circle text-danger"></i>
                                </div>
                                <div class="ps-3">
                                    <h6 class="text-danger">{{ $canceledBookings }}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Upcoming Bookings -->
                {{-- <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Upcoming Bookings</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($upcomingBookings as $booking)
                                    <tr>
                                        <td>{{ $booking->customer_name }}</td>
                                        <td>{{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}</td>
                                        <td><span class="badge bg-warning">{{ ucfirst($booking->status) }}</span></td>
                                    </tr>
                                    @endforeach
                                    @if($upcomingBookings->isEmpty())
                                    <tr>
                                        <td colspan="3" class="text-center">No upcoming bookings</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}

            </div>
        </section>
    </main>
</x-app-layout>
