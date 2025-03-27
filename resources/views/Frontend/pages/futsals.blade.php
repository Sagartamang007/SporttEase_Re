@extends('Frontend.layouts.Master')

@section('content')
<section class="py-5" style="background-color: #f8f9fa;">
    <div class="container">
        <div class="row d-flex justify-content-center" style="margin-top: 2rem;">
            <div class="col-md-10 col-xl-8 text-center">
                <h3 class="mb-4" style="font-weight: 700; color: #2c3e50;">Available Futsal Courts</h3>
                <p class="mb-4 pb-2 mb-md-5 pb-md-0" style="color: #6c757d; max-width: 700px; margin: 0 auto;">
                    Explore our premium futsal courts and book your game instantly! Filter by name, price, or location to find your perfect match.
                </p>

                <!-- Enhanced Search and Filter Section -->
                <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <input type="text" id="searchInput" class="form-control border-start-0" placeholder="Search by name, price, or location">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select id="filterSelect" class="form-select">
                                    <option value="">Sort by...</option>
                                    <option value="alphabetical">Name (A-Z)</option>
                                    <option value="alphabetical-desc">Name (Z-A)</option>
                                    <option value="price-asc">Price (Low to High)</option>
                                    <option value="price-desc">Price (High to Low)</option>
                                    <option value="location">Location (A-Z)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Filter Tags -->
                        <div class="filter-tags mt-3 d-flex flex-wrap gap-2" id="filterTags">
                            <!-- Filter tags will be added here dynamically -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Count -->
        <div class="row mb-4">
            <div class="col-12">
                <p class="text-muted" id="resultsCount">Showing all futsal courts</p>
            </div>
        </div>

        <div class="row g-4" id="futsalCards">
            @foreach($futsals as $futsal)
            <div class="col-md-6 col-lg-4 futsal-card"
                 data-name="{{ $futsal->futsal_name }}"
                 data-price="{{ $futsal->hourly_price }}"
                 data-location="{{ $futsal->futsal_location }}">
                <div class="card shadow-sm h-100" style="border-radius: 10px; overflow: hidden;">
                    <div class="futsal-image position-relative">
                        <img src="{{ asset($futsal->futsal_image) }}" alt="{{ $futsal->futsal_name }}" class="w-100" style="height: 200px; object-fit: cover;">
                        <div class="position-absolute top-0 end-0 m-2">
                            <span class="badge" style="background-color: #198754;">${{ $futsal->hourly_price }}/hr</span>
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-2 fw-bold">{{ $futsal->futsal_name }}</h5>
                        <p class="text-muted mb-3"><i class="fas fa-map-marker-alt me-2"></i>{{ $futsal->futsal_location }}</p>

                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <small class="d-block text-muted"><i class="fas fa-court-vision me-2"></i>{{ $futsal->num_court }} Courts</small>
                            </div>
                            <div>
                                <small class="d-block text-muted"><i class="far fa-clock me-2"></i>{{ $futsal->opening_time }} - {{ $futsal->closing_time }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 text-center">
                        <a href="{{ route('booking', $futsal->id) }}" class="btn w-100" style="background-color: #198754; color: white;">Book Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- No Futsal Courts Available Message -->
        <div class="row mt-4">
            <div class="col-12 text-center py-5" id="noCourtsMessage" style="display: none;">
                <div class="card shadow-sm p-5">
                    <i class="fas fa-search fa-3x text-muted mb-3"></i>
                    <h4>No futsal courts found</h4>
                    <p class="text-muted">Try adjusting your search criteria or filters</p>
                    <button id="clearFilters" class="btn mt-2" style="border-color: #198754; color: #198754;">Clear all filters</button>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .badge {
        font-weight: 500;
    }
    .filter-tag {
        background-color: #e9ecef;
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .filter-tag .close {
        cursor: pointer;
        font-size: 0.9rem;
    }
    .btn-primary {
        background-color: #198754 !important;
        border-color: #198754 !important;
    }
    .btn-outline-primary {
        color: #198754 !important;
        border-color: #198754 !important;
    }
    .btn-outline-primary:hover {
        background-color: #198754 !important;
        color: white !important;
    }
    .bg-primary {
        background-color: #198754 !important;
    }
    .text-primary {
        color: #198754 !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const filterSelect = document.getElementById("filterSelect");
        const futsalCards = document.querySelectorAll(".futsal-card");
        const noCourtsMessage = document.getElementById("noCourtsMessage");
        const resultsCount = document.getElementById("resultsCount");
        const filterTags = document.getElementById("filterTags");
        const clearFiltersBtn = document.getElementById("clearFilters");

        let activeFilters = {
            search: "",
            sort: ""
        };

        // Function to update filter tags
        function updateFilterTags() {
            filterTags.innerHTML = "";

            if (activeFilters.search) {
                const searchTag = document.createElement("span");
                searchTag.className = "filter-tag";
                searchTag.innerHTML = `Search: "${activeFilters.search}" <span class="close" data-filter="search">&times;</span>`;
                filterTags.appendChild(searchTag);
            }

            if (activeFilters.sort) {
                let sortText = "";
                switch(activeFilters.sort) {
                    case "alphabetical": sortText = "Name (A-Z)"; break;
                    case "alphabetical-desc": sortText = "Name (Z-A)"; break;
                    case "price-asc": sortText = "Price (Low to High)"; break;
                    case "price-desc": sortText = "Price (High to Low)"; break;
                    case "location": sortText = "Location (A-Z)"; break;
                }

                const sortTag = document.createElement("span");
                sortTag.className = "filter-tag";
                sortTag.innerHTML = `Sort: ${sortText} <span class="close" data-filter="sort">&times;</span>`;
                filterTags.appendChild(sortTag);
            }

            // Add event listeners to close buttons
            document.querySelectorAll(".filter-tag .close").forEach(closeBtn => {
                closeBtn.addEventListener("click", function() {
                    const filterType = this.getAttribute("data-filter");
                    activeFilters[filterType] = "";

                    if (filterType === "search") {
                        searchInput.value = "";
                    }
                    if (filterType === "sort") {
                        filterSelect.value = "";
                    }

                    updateFilterTags();
                    applyFilters();
                });
            });
        }

        // Function to filter and sort the cards
        function applyFilters() {
            const searchQuery = activeFilters.search.toLowerCase();
            const sortCriteria = activeFilters.sort;

            let filteredCards = Array.from(futsalCards);

            // Apply search filter
            if (searchQuery) {
                filteredCards = filteredCards.filter(card => {
                    const name = card.getAttribute("data-name").toLowerCase();
                    const price = card.getAttribute("data-price").toLowerCase();
                    const location = card.getAttribute("data-location").toLowerCase();

                    return name.includes(searchQuery) ||
                           price.includes(searchQuery) ||
                           location.includes(searchQuery);
                });
            }

            // Apply sorting
            if (sortCriteria) {
                switch(sortCriteria) {
                    case "alphabetical":
                        filteredCards.sort((a, b) => {
                            const nameA = a.getAttribute("data-name").toLowerCase();
                            const nameB = b.getAttribute("data-name").toLowerCase();
                            return nameA.localeCompare(nameB);
                        });
                        break;
                    case "alphabetical-desc":
                        filteredCards.sort((a, b) => {
                            const nameA = a.getAttribute("data-name").toLowerCase();
                            const nameB = b.getAttribute("data-name").toLowerCase();
                            return nameB.localeCompare(nameA);
                        });
                        break;
                    case "price-asc":
                        filteredCards.sort((a, b) => {
                            const priceA = parseFloat(a.getAttribute("data-price"));
                            const priceB = parseFloat(b.getAttribute("data-price"));
                            return priceA - priceB;
                        });
                        break;
                    case "price-desc":
                        filteredCards.sort((a, b) => {
                            const priceA = parseFloat(a.getAttribute("data-price"));
                            const priceB = parseFloat(b.getAttribute("data-price"));
                            return priceB - priceA;
                        });
                        break;
                    case "location":
                        filteredCards.sort((a, b) => {
                            const locationA = a.getAttribute("data-location").toLowerCase();
                            const locationB = b.getAttribute("data-location").toLowerCase();
                            return locationA.localeCompare(locationB);
                        });
                        break;
                }
            }

            // Update the DOM
            const futsalCardsContainer = document.getElementById("futsalCards");
            futsalCardsContainer.innerHTML = "";
            filteredCards.forEach(card => {
                futsalCardsContainer.appendChild(card);
            });

            // Update results count
            resultsCount.textContent = `Showing ${filteredCards.length} of ${futsalCards.length} futsal courts`;

            // Show/hide no results message
            if (filteredCards.length === 0) {
                noCourtsMessage.style.display = "block";
            } else {
                noCourtsMessage.style.display = "none";
            }
        }

        // Event listener for search input
        searchInput.addEventListener("input", function() {
            activeFilters.search = this.value;
            updateFilterTags();
            applyFilters();
        });

        // Event listener for sort select
        filterSelect.addEventListener("change", function() {
            activeFilters.sort = this.value;
            updateFilterTags();
            applyFilters();
        });

        // Event listener for clear filters button
        clearFiltersBtn.addEventListener("click", function() {
            activeFilters.search = "";
            activeFilters.sort = "";
            searchInput.value = "";
            filterSelect.value = "";
            updateFilterTags();
            applyFilters();
        });

        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    });
</script>
@endsection
