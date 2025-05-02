@extends('Frontend.layouts.Master')

@section('content')
<div class="container py-5" style="margin-top: 3rem;">
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="fw-bold mb-0" style="color: #198754;">My Bookings</h3>
            <p class="text-muted">View and manage your futsal court reservations</p>
        </div>
    </div>

    @if($bookings->count())
        <div class="card shadow-sm border-0 overflow-hidden">
            <div class="card-header bg-white py-3 border-bottom" style="border-color: #e9ecef !important;">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="mb-0" style="color: #198754;">All Reservations</h6>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead style="background-color: rgba(25, 135, 84, 0.1);">
                            <tr>
                                <th class="px-4 py-3">Futsal</th>
                                <th class="px-4 py-3">Date</th>
                                <th class="px-4 py-3">Time Slot</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Action</th> <!-- Added Action column -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookings as $booking)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle p-2 me-3" style="background-color: rgba(25, 135, 84, 0.15);">
                                            <i class="bi bi-dribbble" style="color: #198754;"></i>
                                        </div>
                                        <span class="fw-medium">{{ $booking->futsal_Court->futsal_name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="d-block">{{ date('d M Y', strtotime($booking->date)) }}</span>
                                    <small class="text-muted">{{ date('l', strtotime($booking->date)) }}</small>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="badge px-3 py-2" style="background-color: rgba(25, 135, 84, 0.15); color: #198754;">
                                        {{ \Carbon\Carbon::parse($booking->start_time)->format('H:i') }} -
                                        {{ \Carbon\Carbon::parse($booking->end_time)->format('H:i') }}
                                    </span>
                                </td>

                                <td class="px-4 py-3">
                                    @if($booking->status == 'confirmed')
                                        <span class="badge" style="background-color: #198754;">Confirmed</span>
                                    @elseif($booking->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($booking->status) }}</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    @if($booking->status == 'confirmed' || $booking->status == 'pending')
                                        <form action="{{ route('booking.cancel', $booking->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to cancel this booking?')">Cancel</button>
                                        </form>
                                    @elseif($booking->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-4">
            <small class="text-muted">Showing {{ $bookings->count() }} bookings</small>

            <!-- Pagination would go here if you have it -->
            @if(isset($bookings->links))
                <div class="pagination-container">
                    {{ $bookings->links() }}
                </div>
            @endif
        </div>
    @else
        <div class="card shadow-sm border-0 p-5 text-center">
            <div class="py-5">
                <div class="mb-4">
                    <i class="bi bi-calendar-x" style="font-size: 3rem; color: #198754;"></i>
                </div>
                <h5 class="mb-3">No Bookings Found</h5>
                <p class="text-muted mb-4">You haven't made any futsal court bookings yet.</p>
            </div>
        </div>
    @endif
</div>
@endsection
