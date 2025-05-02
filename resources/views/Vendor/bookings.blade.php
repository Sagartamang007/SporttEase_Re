<x-app-layout>
    <main id="main" class="main">
        <section class="section">
            <div class="row">

                <!-- Booking Table -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                        <div class="card-header d-flex justify-content-between align-items-center py-3">
                            <div>
                                <h5 class="card-title fw-bold mb-0">Booking Information</h5>
                                <p class="text-muted small mb-0">Manage your futsal court bookings</p>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="input-group input-group-sm date-filter">
                                    <input type="date" class="form-control" placeholder="Filter by date">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="bi bi-funnel"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover booking-table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="ps-4">Customer</th>
                                            <th>Date</th>
                                            <th>Time Slot</th>
                                            <th>Status</th>
                                            <th>Court No.</th> <!-- NEW -->
                                            <th>Payment</th> <!-- NEW -->
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($bookings as $booking)
                                        <tr>
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle">{{ substr($booking->user->name, 0, 2) }}</div>
                                                    <div class="ms-2">
                                                        <div class="fw-semibold">{{$booking->user->name}}</div>
                                                        <div class="text-muted small">{{$booking->user->email}}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($booking->date)->format('d M, Y') }}
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($booking->start_time)->format('h:i A') }} -
                                                {{ \Carbon\Carbon::parse($booking->end_time)->format('h:i A') }}
                                            </td>
                                            <td class="text-end pe-4">
                                                <span class="badge bg-success-subtle text-success">{{$booking->status}}</span>
                                            </td>
                                            <td>
                                                {{ $booking->court->name ?? 'Court #' . $booking->futsal_court_id }}
                                            </td>

                                            <td>
                                                @if ($booking->payment_method)
                                                    <span class="badge bg-info-subtle text-info text-capitalize">
                                                        {{ $booking->payment_method }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning-subtle text-warning">Cash</span>
                                                @endif
                                            </td>
                                            <td class="text-end pe-4">
                                                <!-- Cancel Button -->
                                                @if (strtolower($booking->status) !== 'cancelled')
                                                    <form action="{{ route('vendor.cancelBooking', $booking->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="bi bi-x-circle"></i> Cancel
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="text-muted">Cancelled</span>
                                                @endif
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Empty State (Hidden by default) -->
                            <div class="empty-state d-none py-5 text-center">
                                <div class="empty-state-icon mb-3">
                                    <i class="bi bi-calendar-x"></i>
                                </div>
                                <h6>No Bookings Found</h6>
                                <p class="text-muted">There are no bookings to display for the selected period.</p>
                            </div>
                        </div>
                        <div class="card-footer bg-white d-flex justify-content-between align-items-center py-3">
                            <!-- Pagination -->


                            <nav aria-label="Page navigation">
                                <ul class="pagination pagination-sm mb-0">
                                    {{ $bookings->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <style>
        /* Custom Styles */
        .main {
            padding: 2rem;
            background-color: #f8f9fa;
        }

        .card {
            transition: all 0.2s ease;
        }

        .card-header {
            background-color: white;
            border-bottom: 1px solid rgba(0,0,0,0.08);
        }

        .card-footer {
            border-top: 1px solid rgba(0,0,0,0.08);
        }

        .booking-table thead th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #e9ecef;
            padding: 0.75rem 1rem;
        }

        .booking-table tbody tr {
            border-bottom: 1px solid #e9ecef;
            transition: background-color 0.15s ease;
        }

        .booking-table tbody tr:last-child {
            border-bottom: none;
        }

        .booking-table tbody tr:hover {
            background-color: rgba(0,0,0,0.02);
        }

        .booking-table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .avatar-circle {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: #e9ecef;
            color: #495057;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .badge {
            font-weight: 500;
            padding: 0.4rem 0.65rem;
            border-radius: 0.25rem;
        }

        .bg-success-subtle {
            background-color: rgba(25, 135, 84, 0.1);
        }

        .bg-warning-subtle {
            background-color: rgba(255, 193, 7, 0.1);
        }

        .bg-danger-subtle {
            background-color: rgba(220, 53, 69, 0.1);
        }

        .bg-info-subtle {
            background-color: rgba(13, 202, 240, 0.1);
        }

        .date-filter {
            width: 200px;
        }

        .empty-state-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: 1.5rem;
            color: #6c757d;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .main {
                padding: 1rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .date-filter {
                width: 100%;
                margin-top: 1rem;
            }

            .booking-table {
                min-width: 650px;
            }
        }
    </style>
</x-app-layout>
