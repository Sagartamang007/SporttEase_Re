@extends('Frontend.layouts.Master')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row d-flex justify-content-center" style="margin-top: 2rem;">
            <div class="col-md-10 col-xl-8 text-center">
                <h3 class="mb-4">Available Futsal Courts</h3>
                <p class="mb-4 pb-2 mb-md-5 pb-md-0">
                    Explore our premium futsal courts and book your game instantly!
                </p>

                <!-- Search Bar and Sorting Icons -->
                <div class="d-flex justify-content-center align-items-center">
                    <input type="text" id="searchInput" class="form-control w-50" placeholder="Search by name, price, or location">

                    <!-- Sorting Icons with Tooltips -->
                    <div class="ms-2">
                        <button id="sortAlphabetical" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Sort Alphabetically">
                            <i class="fas fa-sort-alpha-down"></i>
                        </button>
                        <button id="sortPrice" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Sort by Price">
                            <i class="fas fa-tag"></i>
                        </button>
                        <button id="sortLocation" class="btn btn-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Sort by Location">
                            <i class="fas fa-map-marker-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="futsalCards">
            @foreach($futsals as $futsal)
            <div class="col-md-6 col-lg-4 futsal-card" data-name="{{ $futsal->futsal_name }}" data-price="{{ $futsal->hourly_price }}" data-location="{{ $futsal->futsal_location }}">
                <div class="card shadow-sm">
                    <div class="futsal-image">
                        <img src="{{ asset($futsal->futsal_image) }}" alt="Futsal Image" class="w-100 rounded-top">
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title mb-2">{{ $futsal->futsal_name}}</h5>
                        <p class="text-muted"><i class="fas fa-map-marker-alt"></i> {{ $futsal->futsal_location }}</p>
                        <p><strong>Price:</strong> ${{ $futsal->hourly_price }}</p>
                        <p><strong>Number of Courts:</strong> {{ $futsal->num_court }}</p>
                        <p><strong>Opening Time:</strong> {{ $futsal->opening_time }}</p>
                        <p><strong>Closing Time:</strong> {{ $futsal->closing_time }}</p>
                        <a href="{{ route('booking', $futsal->id) }}" class="btn btn-primary">Book Now</a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <!-- No Futsal Courts Available Message -->
        <div class="col-12 text-center" id="noCourtsMessage" style="display: none;">
            <p>No futsal courts are currently available.</p>
        </div>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const futsalCards = document.querySelectorAll(".futsal-card");
        const noCourtsMessage = document.getElementById("noCourtsMessage");

        // Function to filter the cards based on search input
        function filterCards() {
            const searchQuery = searchInput.value.toLowerCase();

            let filteredCards = Array.from(futsalCards).filter(card => {
                const name = card.getAttribute("data-name").toLowerCase();
                return name.includes(searchQuery);
            });

            // Append filtered cards to the row
            const futsalCardsContainer = document.getElementById("futsalCards");
            futsalCardsContainer.innerHTML = "";
            filteredCards.forEach(card => {
                futsalCardsContainer.appendChild(card);
            });

            // Display "No futsal courts" message if no cards match the filter
            if (filteredCards.length === 0) {
                noCourtsMessage.style.display = "block";
            } else {
                noCourtsMessage.style.display = "none";
            }
        }

        // Sorting functionality based on the selected icon
        function sortCards(criteria) {
            let sortedCards = Array.from(futsalCards);

            if (criteria === "alphabetical") {
                sortedCards.sort((a, b) => {
                    const nameA = a.getAttribute("data-name").toLowerCase();
                    const nameB = b.getAttribute("data-name").toLowerCase();
                    return nameA.localeCompare(nameB);
                });
            } else if (criteria === "price") {
                sortedCards.sort((a, b) => {
                    const priceA = parseFloat(a.getAttribute("data-price"));
                    const priceB = parseFloat(b.getAttribute("data-price"));
                    return priceA - priceB;
                });
            } else if (criteria === "location") {
                sortedCards.sort((a, b) => {
                    const locationA = a.getAttribute("data-location").toLowerCase();
                    const locationB = b.getAttribute("data-location").toLowerCase();
                    return locationA.localeCompare(locationB);
                });
            }

            // Append sorted cards to the row
            const futsalCardsContainer = document.getElementById("futsalCards");
            futsalCardsContainer.innerHTML = "";
            sortedCards.forEach(card => {
                futsalCardsContainer.appendChild(card);
            });
        }

        // Event listeners for sorting
        document.getElementById("sortAlphabetical").addEventListener("click", function() {
            sortCards("alphabetical");
        });

        document.getElementById("sortPrice").addEventListener("click", function() {
            sortCards("price");
        });

        document.getElementById("sortLocation").addEventListener("click", function() {
            sortCards("location");
        });

        // Event listener for search input
        searchInput.addEventListener("input", filterCards);
    });
</script>
@endsection
