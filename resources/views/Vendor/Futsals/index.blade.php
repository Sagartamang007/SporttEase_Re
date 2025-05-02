<x-app-layout>
    <main id="main" class="main bg-light py-4">
        <div class="container">
            <!-- Header Section -->
            <div class="card border-0 shadow-sm rounded-3 mb-4 header-card">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-6 mb-3 mb-lg-0">
                            <div class="d-flex align-items-center">
                                <div class="icon-box bg-success text-white me-3">
                                    <i class="bi bi-trophy"></i>
                                </div>
                                <div>
                                    <h1 class="fs-3 fw-bold mb-1">Futsal Courts</h1>
                                    <p class="text-muted mb-0">Manage all your futsal courts in one place</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="d-flex flex-column flex-sm-row gap-2 justify-content-lg-end">
                                <div class="search-box flex-grow-1 flex-lg-grow-0">
                                    <div class="input-group">
                                        <span class="input-group-text bg-white border-end-0">
                                            <i class="bi bi-search"></i>
                                        </span>
                                        <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search courts...">
                                    </div>
                                </div>
                                <a href="{{ route('futsal.create') }}" class="btn btn-success">
                                    <i class="bi bi-plus-circle me-2"></i>Add New Court
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Courts Display Section -->
            <div class="courts-container">
                <!-- Card View / List View Toggle -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="results-info">
                        <span class="text-muted">Showing <span id="courtCount">{{ count($futsalCourts) }}</span> courts</span>
                    </div>
                    <div class="view-options">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-outline-secondary active" id="cardViewBtn">
                                <i class="bi bi-grid"></i>
                            </button>
                            <button type="button" class="btn btn-outline-secondary" id="listViewBtn">
                                <i class="bi bi-list"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Card View (Default) -->
                <div id="cardView" class="row g-3 mb-4">
                    @forelse ($futsalCourts as $court)
                        <div class="col-xl-3 col-lg-4 col-md-6 court-item">
                            <div class="card h-100 border-0 shadow-sm hover-card">
                                <div class="position-relative">
                                    @if($court->futsal_image)
                                        <img src="{{ asset($court->futsal_image) }}" class="card-img-top court-image" alt="{{ $court->futsal_name }}">
                                    @else
                                        <div class="card-img-top court-image-placeholder d-flex align-items-center justify-content-center bg-light">
                                            <i class="bi bi-image text-muted" style="font-size: 3rem;"></i>
                                        </div>
                                    @endif
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-success rounded-pill px-3 py-2">
                                            NRs.{{ $court->hourly_price }}/hr
                                        </span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-1 text-truncate">{{ $court->futsal_name }}</h5>
                                    <p class="card-text small text-muted mb-2">
                                        <i class="bi bi-geo-alt me-1"></i>{{ $court->futsal_location }}
                                    </p>
                                    <p class="card-text small mb-3">{{ Str::limit($court->futsal_description, 60) }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="court-info">
                                            <span class="badge bg-light text-dark me-1">
                                                <i class="bi bi-hash text-success me-1"></i>{{ $court->num_court }} Courts
                                            </span>
                                        </div>
                                        <div class="court-time small">
                                            <span class="text-muted">{{ $court->opening_time }} - {{ $court->closing_time }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-white border-top-0 pt-0">
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('futsal.show', $court->id) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye me-1"></i>View
                                        </a>
                                        <div class="btn-group">
                                            <a href="{{ route('futsal.edit', $court->id) }}" class="btn btn-sm btn-outline-secondary">
                                                <i class="bi bi-pencil me-1"></i>Edit
                                            </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                            data-id="{{ $court->id }}"
                                            data-name="{{ $court->futsal_name }}"
                                            data-url="{{ route('futsal.destroy', $court->id) }}">
                                        <i class="bi bi-trash me-1"></i>Delete
                                    </button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-5 text-center">
                                    <div class="empty-state">
                                        <div class="empty-state-icon mb-4">
                                            <i class="bi bi-emoji-frown"></i>
                                        </div>
                                        <h3>No Futsal Courts Found</h3>
                                        <p class="text-muted mb-4">You haven't added any futsal courts yet. Get started by creating your first court.</p>
                                        <a href="{{ route('futsal.create') }}" class="btn btn-success px-4">
                                            <i class="bi bi-plus-circle me-2"></i>Create New Court
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>

                <!-- List View (Hidden by Default) -->
                <div id="listView" class="mb-4" style="display: none;">
                    <div class="card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="py-3">Name</th>
                                        <th class="py-3">Location</th>
                                        <th class="py-3 d-none d-md-table-cell">Description</th>
                                        <th class="py-3 d-none d-lg-table-cell">Courts</th>
                                        <th class="py-3 d-none d-lg-table-cell">Hours</th>
                                        <th class="py-3">Price</th>
                                        <th class="py-3 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($futsalCourts as $court)
                                        <tr class="court-item">
                                            <td class="fw-medium">{{ $court->futsal_name }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <i class="bi bi-geo-alt text-success me-2"></i>
                                                    {{ $court->futsal_location }}
                                                </div>
                                            </td>
                                            <td class="d-none d-md-table-cell">{{ Str::limit($court->futsal_description, 50) }}</td>
                                            <td class="d-none d-lg-table-cell">
                                                <span class="badge bg-light text-dark">{{ $court->num_court }}</span>
                                            </td>
                                            <td class="d-none d-lg-table-cell">
                                                <small>{{ $court->opening_time }} - {{ $court->closing_time }}</small>
                                            </td>
                                            <td>
                                                <span class="badge bg-success rounded-pill">
                                                    Nrs.{{ $court->hourly_price }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end gap-2">
                                                    <a href="{{ route('futsal.show', $court->id) }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <a href="{{ route('futsal.edit', $court->id) }}" class="btn btn-sm btn-outline-secondary">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-btn"
                                                            data-id="{{ $court->id }}"
                                                            data-name="{{ $court->futsal_name }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-5">
                                                <div class="empty-state">
                                                    <div class="empty-state-icon mb-3">
                                                        <i class="bi bi-emoji-frown"></i>
                                                    </div>
                                                    <h5>No Futsal Courts Found</h5>
                                                    <p class="text-muted mb-3">You haven't added any futsal courts yet.</p>
                                                    <a href="{{ route('futsal.create') }}" class="btn btn-success btn-sm">
                                                        <i class="bi bi-plus-circle me-2"></i>Create New Court
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Deletion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <strong id="courtName"></strong>? This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                        <!-- Changed this line to use a placeholder action that will be set by JavaScript -->
                        <form id="deleteForm" method="POST" >
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete Court</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <style>
    /* Modern, clean styling */
    :root {
        --primary: #0d6efd;
        --success: #198754;
        --danger: #dc3545;
        --warning: #ffc107;
        --info: #0dcaf0;
        --light: #f8f9fa;
        --dark: #212529;
        --border-color: #dee2e6;
        --border-radius: 0.375rem;
        --box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        --transition: all 0.2s ease-in-out;
    }

    body {
        background-color: var(--light);
        color: var(--dark);
    }

    /* Icon box */
    .icon-box {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Header card */
    .header-card {
        border-left: 4px solid var(--success);
    }

    /* Search box */
    .search-box .form-control:focus {
        box-shadow: none;
        border-color: var(--border-color);
    }

    /* Court cards */
    .court-image, .court-image-placeholder {
        height: 160px;
        object-fit: cover;
    }

    .hover-card {
        transition: var(--transition);
    }

    .hover-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }

    /* Empty state */
    .empty-state {
        padding: 1.5rem;
    }

    .empty-state-icon {
        font-size: 3rem;
        color: #adb5bd;
    }

    /* View toggle buttons */
    .view-options .btn-group .btn.active {
        background-color: var(--success);
        color: white;
        border-color: var(--success);
    }

    /* Responsive adjustments */
    @media (max-width: 767.98px) {
        .header-card .card-body {
            padding: 1.25rem;
        }

        .icon-box {
            width: 40px;
            height: 40px;
            font-size: 1rem;
        }

        .court-image, .court-image-placeholder {
            height: 140px;
        }
    }

    @media (max-width: 575.98px) {
        .header-card h1 {
            font-size: 1.5rem;
        }

        .btn {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
        }

        .card-title {
            font-size: 1rem;
        }
    }
    </style>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    // Toggle between card and list view
    const cardViewBtn = document.getElementById('cardViewBtn');
    const listViewBtn = document.getElementById('listViewBtn');
    const cardView = document.getElementById('cardView');
    const listView = document.getElementById('listView');

    cardViewBtn.addEventListener('click', function() {
        cardView.style.display = 'flex';
        listView.style.display = 'none';
        cardViewBtn.classList.add('active');
        listViewBtn.classList.remove('active');
    });

    listViewBtn.addEventListener('click', function() {
        cardView.style.display = 'none';
        listView.style.display = 'block';
        listViewBtn.classList.add('active');
        cardViewBtn.classList.remove('active');
    });

    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const courtItems = document.querySelectorAll('.court-item');
    const courtCount = document.getElementById('courtCount');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        let visibleCount = 0;

        courtItems.forEach(item => {
            const courtName = item.querySelector('.card-title, .fw-medium').textContent.toLowerCase();
            const courtLocation = item.querySelector('.text-muted, td:nth-child(2)').textContent.toLowerCase();

            if (courtName.includes(searchTerm) || courtLocation.includes(searchTerm)) {
                item.style.display = '';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        courtCount.textContent = visibleCount;
    });

    // Delete confirmation modal
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const deleteForm = document.getElementById('deleteForm');
    const courtNameElement = document.getElementById('courtName');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const courtId = this.getAttribute('data-id');
            const courtName = this.getAttribute('data-name');
            const deleteUrl = this.getAttribute('data-url');  // Get the full URL from the data-url attribute

            // Update the delete form action dynamically
            deleteForm.action = deleteUrl;
            courtNameElement.textContent = courtName;
            deleteModal.show();
        });
    });
});

    </script>
</x-app-layout>
