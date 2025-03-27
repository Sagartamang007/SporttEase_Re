@extends('admin.layouts.app')
@section('content')
<style>
    /* Custom Alert Styles */
    .alert-custom-success {
        background-color: #d1e7dd;
        border-color: #badbcc;
        color: #0f5132;
        border-left: 5px solid #198754;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        padding: 16px;
        position: relative;
        animation: slideInDown 0.5s ease-in-out;
    }

    @keyframes slideInDown {
        from {
            transform: translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .alert-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 24px;
        height: 24px;
        background-color: #198754;
        border-radius: 50%;
        margin-right: 12px;
    }

    .alert-icon i {
        color: white;
        font-size: 12px;
    }

    /* Custom Button Styles */
    .btn-edit-custom {
        background: linear-gradient(145deg, #4e73df, #3a54a7);
        border: none;
        color: white;
        border-radius: 6px;
        padding: 6px 14px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(78, 115, 223, 0.3);
    }

    .btn-edit-custom:hover {
        background: linear-gradient(145deg, #3a54a7, #4e73df);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(78, 115, 223, 0.4);
        color: white;
    }

    .btn-delete-custom {
        background: linear-gradient(145deg, #e74a3b, #c0392b);
        border: none;
        color: white;
        border-radius: 6px;
        padding: 6px 14px;
        transition: all 0.3s ease;
        box-shadow: 0 2px 4px rgba(231, 74, 59, 0.3);
    }

    .btn-delete-custom:hover {
        background: linear-gradient(145deg, #c0392b, #e74a3b);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(231, 74, 59, 0.4);
        color: white;
    }

    /* Custom Modal Styles */
    .modal-header-custom {
        background: linear-gradient(145deg, #e74a3b, #c0392b);
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
        padding: 15px 20px;
    }

    .modal-content-custom {
        border: none;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .modal-body-custom {
        padding: 20px;
    }

    .modal-footer-custom {
        border-top: 1px solid #f1f1f1;
        padding: 15px 20px;
    }

    .team-member-card {
        background-color: #f8f9fc;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        border-left: 4px solid #4e73df;
    }

    /* Table Enhancements */
    .table-custom thead th {
        background-color: #f8f9fc;
        border-bottom: 2px solid #e3e6f0;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.05em;
        padding: 12px 15px;
    }

    .table-custom tbody tr {
        transition: all 0.2s ease;
    }

    .table-custom tbody tr:hover {
        background-color: #f1f5ff !important;
    }

    /* Card Enhancements */
    .card-custom {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        transition: all 0.3s ease;
    }

    .card-custom:hover {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.25);
    }

    .card-header-custom {
        background: linear-gradient(to right, #4e73df, #36b9cc);
        color: white;
        border-top-left-radius: 10px !important;
        border-top-right-radius: 10px !important;
        padding: 15px 20px;
    }

    .search-box-custom {
        border-radius: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .search-input-custom {
        border: none;
        padding: 10px 15px;
    }

    .search-input-custom:focus {
        box-shadow: none;
    }

    .search-button-custom {
        border-radius: 0 20px 20px 0 !important;
        padding: 0 20px;
    }
</style>


<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Team Members</h2>
        <a href="{{ route('team.create') }}" class="btn btn-success d-flex align-items-center">
            <i class="fas fa-plus-circle me-2"></i> Add Team Member
        </a>
    </div>

    @if(session('success'))
        <div class="alert-custom-success d-flex align-items-center mb-4" role="alert">
            <div class="alert-icon">
                <i class="fas fa-check"></i>
            </div>
            <div class="ms-2">{{ session('success') }}</div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close" style="background: none; border: none; font-size: 1.25rem; padding: 0; color: #0f5132; opacity: 0.7;"></button>
        </div>
    @endif

    <div class="card card-custom shadow mb-4">
        <div class="card-header card-header-custom py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold">Manage Team</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-custom" id="teamTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Image</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($teams as $team)
                        <tr>
                            <td class="align-middle">{{ $team->name }}</td>
                            <td class="align-middle">{{ $team->designation }}</td>
                            <td class="align-middle">
                                <img src="{{ asset('storage/' . $team->image) }}" class="rounded" width="60" height="60" alt="{{ $team->name }}" style="object-fit: cover;">
                            </td>
                            <td class="align-middle text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('team.edit', $team->id) }}" class="btn btn-edit-custom me-2" data-bs-toggle="tooltip" title="Edit">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-delete-custom" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $team->id }}">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $team->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $team->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content modal-content-custom">
                                            <div class="modal-header modal-header-custom">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $team->id }}">
                                                    <i class="fas fa-exclamation-triangle me-2"></i> Confirm Delete
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body modal-body-custom">
                                                <div class="team-member-card d-flex align-items-center">
                                                    <img src="{{ asset('storage/' . $team->image) }}" class="rounded-circle me-3" width="60" height="60" alt="{{ $team->name }}" style="object-fit: cover;">
                                                    <div>
                                                        <h6 class="mb-1 fw-bold">{{ $team->name }}</h6>
                                                        <span class="badge bg-info text-white">{{ $team->designation }}</span>
                                                    </div>
                                                </div>
                                                <div class="alert alert-warning mt-3">
                                                    <i class="fas fa-exclamation-circle me-2"></i>
                                                    Are you sure you want to delete this team member? This action cannot be undone.
                                                </div>
                                            </div>
                                            <div class="modal-footer modal-footer-custom">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-1"></i> Cancel
                                                </button>
                                                <form action="{{ route('team.destroy', $team->id) }}" method="POST">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" class="btn btn-delete-custom">
                                                        <i class="fas fa-trash-alt me-1"></i> Delete Member
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="empty-state-icon mb-3">
                                        <i class="fas fa-users fa-4x text-muted opacity-50"></i>
                                    </div>
                                    <h5 class="text-muted mb-3">No team members found</h5>
                                    <p class="text-muted mb-4">Start building your team by adding your first member</p>
                                    <a href="{{ route('team.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus-circle me-2"></i> Add your first team member
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

<script>
    window.setTimeout(function() {
        $('.alert-custom-success').fadeOut(500, function() {
            $(this).remove();
        });
    }, 5000);
</script>
@endsection
