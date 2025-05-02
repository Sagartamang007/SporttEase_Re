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
                                    <h6>{{ $totalVendorsUsers }}</h6>
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

            </div>
        </section>
    </main>
</x-app-layout>
