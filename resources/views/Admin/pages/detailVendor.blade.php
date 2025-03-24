@extends('admin.layouts.app')

@section('content')

    <style>
        /* Vendor Details Styles */
        .vendor-details-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
        }

        h2 {
            color: #2c3e50;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(44, 62, 80, 0.1);
            padding-bottom: 10px;
        }

        .detail-item {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .detail-item strong {
            color: #2c3e50;
        }

        .vendor-doc img {
            width: 120px;
            border-radius: 6px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            cursor: pointer;
        }

        .vendor-doc img:hover {
            transform: scale(1.1);
        }

        .back-btn {
            display: inline-block;
            padding: 10px 16px;
            background-color: #3498db;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
        }

        .back-btn:hover {
            background-color: #2980b9;
        }

        .action-btn {
            display: inline-block;
            padding: 10px 16px;
            background-color: #27ae60;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .action-btn:hover {
            background-color: #229954;
        }

        .danger-btn {
            display: inline-block;
            padding: 10px 16px;
            background-color: #ff0000;
            color: white;
            border-radius: 4px;
            text-decoration: none;
            font-weight: 600;
            transition: 0.3s;
            border: none;
            cursor: pointer;
        }

        .danger-btn:hover {
            background-color: #f11010;
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.8);
        }

        .modal-content {
            margin: auto;
            display: block;
            max-width: 80%;
        }

        .close {
            position: absolute;
            top: 15px;
            right: 25px;
            color: white;
            font-size: 35px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>

    <div class="vendor-details-container">
        <h2>Vendor Details</h2>

        <div class="detail-item"><strong>Name:</strong> {{ $vendor->name }}</div>
        <div class="detail-item"><strong>Company:</strong> {{ $vendor->company_name }}</div>
        <div class="detail-item"><strong>Pan Number:</strong> {{ $vendor->pan_card }}</div>
        <div class="detail-item"><strong>Phone:</strong> {{ $vendor->user->phone }}</div>
        <div class="detail-item"><strong>Status:</strong> {{ $vendor->status }}</div>

        <div class="detail-item vendor-doc">
            <strong>PAN Card:</strong><br>
            <img src="{{ asset('storage/' . $vendor->pan_card_image) }}" alt="PAN Card" onclick="openModal('{{ asset('storage/' . $vendor->pan_card_image) }}')">
        </div>

        <div class="detail-item vendor-doc">
            <strong>Citizenship:</strong><br>
            <img src="{{ asset('storage/' . $vendor->front_citizenship_document) }}" alt="Front Citizenship" onclick="openModal('{{ asset('storage/' . $vendor->front_citizenship_document) }}')">
            <img src="{{ asset('storage/' . $vendor->back_citizenship_document) }}" alt="Back Citizenship" onclick="openModal('{{ asset('storage/' . $vendor->back_citizenship_document) }}')">
        </div>

        <a href="{{ route('admin.vendors') }}" class="back-btn">Back to List</a>

        @if($vendor->status === 'pending')
            <form action="{{ route('admin.approveVendor', $vendor->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="action-btn">Approve </button>
            </form>
        @elseif($vendor->status === 'approved')
            <form action="{{ route('admin.rejectVendor', $vendor->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="danger-btn">Reject </button>
            </form>
        @else
            <form action="{{ route('admin.pendingVendor', $vendor->id) }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="action-btn">Pending </button>
            </form>
        @endif
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <script>
        function openModal(imageSrc) {
            document.getElementById('imageModal').style.display = "block";
            document.getElementById('modalImage').src = imageSrc;
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = "none";
        }

        // Close modal when clicking outside the image
        window.onclick = function(event) {
            var modal = document.getElementById('imageModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

@endsection
