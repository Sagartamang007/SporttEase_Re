<x-app-layout>
    <main id="main" class="main">
        <div class="container my-5">
            <h1 class="text-center mb-4">Create Futsal Court</h1>

            <!-- Form Starts -->
            <form action="{{ route('futsal.store') }}" method="POST" enctype="multipart/form-data" class="card p-4">
                @csrf
                <div class="row">
                    <!-- Futsal Name -->
                    <div class="col-md-6 mb-3">
                        <label for="futsal_name" class="form-label">Futsal Name</label>
                        <input type="text" name="futsal_name" class="form-control" placeholder="Enter Futsal Name" required>
                    </div>

                    <!-- Futsal Location -->
                    <div class="col-md-6 mb-3">
                        <label for="futsal_location" class="form-label">Futsal Location</label>
                        <input type="text" name="futsal_location" class="form-control" placeholder="Enter Futsal Location" required>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="futsal_description" class="form-label">Description</label>
                    <textarea name="futsal_description" class="form-control" rows="4" placeholder="Enter Futsal Description" required></textarea>
                </div>

                <div class="row">
                    <!-- Number of Courts -->
                    <div class="col-md-6 mb-3">
                        <label for="num_court" class="form-label">Number of Courts</label>
                        <input type="number" name="num_court" class="form-control" placeholder="Enter Number of Courts" required>
                    </div>

                    <!-- Opening Time -->
                    <div class="col-md-6 mb-3">
                        <label for="opening_time" class="form-label">Opening Time</label>
                        <input type="time" name="opening_time" class="form-control" required>
                    </div>
                </div>

                <div class="row">
                    <!-- Closing Time -->
                    <div class="col-md-6 mb-3">
                        <label for="closing_time" class="form-label">Closing Time</label>
                        <input type="time" name="closing_time" class="form-control" required>
                    </div>

                    <!-- Hourly Price -->
                    <div class="col-md-6 mb-3">
                        <label for="hourly_price" class="form-label">Hourly Price</label>
                        <input type="number" name="hourly_price" class="form-control" placeholder="Enter Hourly Price" required>
                    </div>
                </div>

                <!-- Futsal Image -->
                <div class="mb-3">
                    <label for="futsal_image" class="form-label">Futsal Image</label>
                    <input type="file" name="futsal_image" class="form-control">
                </div>

                <!-- Submit Button -->
                <div class="text-center mb-3">
                    <button type="submit" class="btn btn-primary px-4 py-2">Save</button>
                </div>
            </form>
            <!-- Form Ends -->

            <!-- Back to Index Button -->
            <div class="text-center">
                <a href="{{ route('futsal.index') }}" class="btn btn-secondary px-4 py-2">Back to Index</a>
            </div>
        </div>
    </main>
</x-app-layout>
