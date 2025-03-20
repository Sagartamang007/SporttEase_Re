<x-app-layout>
    <main id="main" class="main">
        <div class="container-fluid py-4">
            <div class="row mb-4 align-items-center">
                <div class="col-md-6">
                    <h1 class="display-5 fw-bold text-primary">
                        <i class="bi bi-trophy me-2"></i> Futsal Courts
                    </h1>
                    <p class="text-muted">Manage all your futsal courts in one place</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="{{ route('futsal.create') }}" class="btn btn-primary btn-lg rounded-pill shadow">
                        <i class="bi bi-plus-circle me-2"></i>Create New Court
                    </a>
                </div>
            </div>

            <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                <div class="card-header bg-light p-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i> All Courts</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="py-3">Name</th>
                                    <th class="py-3">Location</th>
                                    <th class="py-3">Description</th>
                                    <th class="py-3">Images</th>
                                    <th class="py-3">Number of Courts</th>
                                    <th class="py-3">Opening Time</th>
                                    <th class="py-3">Closing Time</th>
                                    <th class="py-3">Hourly Price</th> <!-- Added Hourly Price column -->
                                    <th class="py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($futsalCourts as $court)
                                    <tr>
                                        <td class="fw-bold">{{ $court->futsal_name }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-geo-alt text-primary me-2"></i>
                                                {{ $court->futsal_location }}
                                            </div>
                                        </td>
                                        <td>{{ Str::limit($court->futsal_description, 50) }}</td>
                                        <td>
                                            @if ($court->futsal_images)
                                            <div class="d-flex gap-1">
                                                @foreach (json_decode($court->futsal_images) as $image)
                                                    <img src="{{ Storage::url($image) }}" alt="Image"
                                                         class="rounded shadow-sm" width="60" height="60"
                                                         style="object-fit: cover;">
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="badge bg-light text-dark">No images</span>
                                        @endif

                                        </td>
                                        <td>
                                            <span class="badge bg-primary rounded-pill">{{ $court->num_court }}</span>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-clock text-success me-2"></i>
                                                {{ $court->opening_time }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="bi bi-clock-history text-danger me-2"></i>
                                                {{ $court->closing_time }}
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info rounded-pill">
                                                ${{ $court->hourly_price }} <!-- Display Hourly Price -->
                                            </span>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ route('futsal.show', $court->id) }}"
                                                   class="btn btn-info btn-sm rounded-pill">
                                                    <i class="bi bi-eye me-1"></i>View
                                                </a>
                                                <a href="{{ route('futsal.edit', $court->id) }}"
                                                   class="btn btn-warning btn-sm rounded-pill">
                                                    <i class="bi bi-pencil me-1"></i>Edit
                                                </a>
                                                <form action="{{ route('futsal.destroy', $court->id) }}" method="POST"
                                                    style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this futsal court?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm rounded-pill">
                                                        <i class="bi bi-trash me-1"></i>Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                                @if(count($futsalCourts) == 0)
                                    <tr>
                                        <td colspan="9" class="text-center py-5"> <!-- Updated colspan to 9 -->
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="bi bi-emoji-frown text-muted" style="font-size: 3rem;"></i>
                                                <h5 class="mt-3">No futsal courts found</h5>
                                                <p class="text-muted">Create your first futsal court to get started</p>
                                                <a href="{{ route('futsal.create') }}" class="btn btn-primary mt-2">
                                                    <i class="bi bi-plus-circle me-2"></i>Create New Court
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>
