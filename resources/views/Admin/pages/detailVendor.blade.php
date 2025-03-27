@extends('admin.layouts.app')

@section('content')

    <style>
        /* Vendor Details Styles */
        :root {
            --primary-color: #3498db;
            --primary-dark: #2980b9;
            --success-color: #2ecc71;
            --success-dark: #27ae60;
            --danger-color: #e74c3c;
            --danger-dark: #c0392b;
            --warning-color: #f39c12;
            --warning-dark: #e67e22;
            --text-color: #2c3e50;
            --text-light: #7f8c8d;
            --border-color: #ecf0f1;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            --hover-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .vendor-details-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            padding: 30px;
            max-width: 850px;
            margin: 20px auto;
            width: 95%;
            transition: all 0.3s ease;
        }

        .vendor-details-container:hover {
            box-shadow: var(--hover-shadow);
        }

        .section-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 15px;
        }

        h2 {
            color: var(--text-color);
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            flex-grow: 1;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .detail-item {
            margin-bottom: 20px;
            font-size: 16px;
            word-break: break-word;
            transition: all 0.2s ease;
            padding: 10px;
            border-radius: 8px;
        }

        .detail-item:hover {
            background-color: rgba(236, 240, 241, 0.5);
        }

        .detail-item strong {
            color: var(--text-color);
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-item .value {
            font-size: 18px;
            color: var(--text-color);
        }

        .documents-section {
            margin-top: 30px;
            background-color: rgba(236, 240, 241, 0.3);
            border-radius: 10px;
            padding: 20px;
        }

        .documents-section h3 {
            font-size: 20px;
            color: var(--text-color);
            margin-bottom: 20px;
            font-weight: 600;
        }

        .document-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 20px;
        }

        .document-item {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .document-item span {
            font-size: 14px;
            color: var(--text-light);
            margin-bottom: 10px;
            text-align: center;
        }

        .vendor-doc img {
            width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            border: 3px solid white;
        }

        .vendor-doc img:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .action-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 30px;
            justify-content: flex-start;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 16px;
            min-width: 150px;
            text-decoration: none;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn:active {
            transform: translateY(-1px);
        }

        .back-btn {
            background-color: var(--primary-color);
            color: white;
        }

        .back-btn:hover {
            background-color: var(--primary-dark);
        }

        .action-btn {
            background-color: var(--success-color);
            color: white;
        }

        .action-btn:hover {
            background-color: var(--success-dark);
        }

        .danger-btn {
            background-color: var(--danger-color);
            color: white;
        }

        .danger-btn:hover {
            background-color: var(--danger-dark);
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 8px 16px;
            border-radius: 50px;
            font-weight: 600;
            text-transform: capitalize;
            font-size: 14px;
        }

        .status-badge::before {
            content: "";
            display: inline-block;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .status-pending {
            background-color: rgba(243, 156, 18, 0.15);
            color: var(--warning-dark);
        }

        .status-pending::before {
            background-color: var(--warning-color);
        }

        .status-approved {
            background-color: rgba(46, 204, 113, 0.15);
            color: var(--success-dark);
        }

        .status-approved::before {
            background-color: var(--success-color);
        }

        .status-rejected {
            background-color: rgba(231, 76, 60, 0.15);
            color: var(--danger-dark);
        }

        .status-rejected::before {
            background-color: var(--danger-color);
        }

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.9);
            transition: all 0.3s ease;
            backdrop-filter: blur(5px);
        }

        .modal-content-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90vh;
            object-fit: contain;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: zoom 0.3s ease;
            margin: 0; /* Remove any margin */
            display: block;
        }

        @keyframes zoom {
            from {transform: scale(0.9); opacity: 0;}
            to {transform: scale(1); opacity: 1;}
        }

        .close {
            position: absolute;
            top: 20px;
            right: 30px;
            color: white;
            font-size: 40px;
            font-weight: bold;
            cursor: pointer;
            z-index: 1001;
            transition: all 0.3s ease;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 0, 0.3);
            border-radius: 50%;
        }

        .close:hover {
            color: #f1f1f1;
            transform: rotate(90deg);
            background-color: rgba(231, 76, 60, 0.7);
        }

        .modal-controls {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            z-index: 1001;
        }

        .zoom-controls {
            display: inline-flex;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50px;
            padding: 10px;
            gap: 15px;
        }

        .zoom-btn {
            color: white;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
        }

        .zoom-btn:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .vendor-details-container {
                padding: 20px;
                margin: 10px auto;
            }

            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            h2 {
                font-size: 24px;
            }

            .details-grid {
                grid-template-columns: 1fr;
                gap: 10px;
            }

            .document-grid {
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                gap: 15px;
            }

            .vendor-doc img {
                width: 120px;
                height: 120px;
            }

            .action-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
            }

            .close {
                top: 10px;
                right: 10px;
                font-size: 30px;
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 480px) {
            .vendor-details-container {
                padding: 15px;
            }
        }
    </style>

    <div class="vendor-details-container">
        <div class="section-header">
            <h2>Vendor Details</h2>
            <span class="status-badge status-{{ strtolower($vendor->status) }}">
                {{ $vendor->status }}
            </span>
        </div>

        <div class="details-grid">
            <div class="detail-item">
                <strong>Full Name</strong>
                <div class="value">{{ $vendor->name }}</div>
            </div>

            <div class="detail-item">
                <strong>Company Name</strong>
                <div class="value">{{ $vendor->company_name }}</div>
            </div>

            <div class="detail-item">
                <strong>PAN Number</strong>
                <div class="value">{{ $vendor->pan_card }}</div>
            </div>

            <div class="detail-item">
                <strong>Contact Number</strong>
                <div class="value">{{ $vendor->user->phone }}</div>
            </div>
        </div>

        <div class="documents-section">
            <h3>Verification Documents</h3>
            <div class="document-grid">
                <div class="document-item">
                    <span>PAN Card</span>
                    <div class="vendor-doc">
                        <img src="{{ asset('storage/' . $vendor->pan_card_image) }}" alt="PAN Card" onclick="openModal('{{ asset('storage/' . $vendor->pan_card_image) }}', 'PAN Card')">
                    </div>
                </div>

                <div class="document-item">
                    <span>Citizenship (Front)</span>
                    <div class="vendor-doc">
                        <img src="{{ asset('storage/' . $vendor->front_citizenship_document) }}" alt="Front Citizenship" onclick="openModal('{{ asset('storage/' . $vendor->front_citizenship_document) }}', 'Citizenship (Front)')">
                    </div>
                </div>

                <div class="document-item">
                    <span>Citizenship (Back)</span>
                    <div class="vendor-doc">
                        <img src="{{ asset('storage/' . $vendor->back_citizenship_document) }}" alt="Back Citizenship" onclick="openModal('{{ asset('storage/' . $vendor->back_citizenship_document) }}', 'Citizenship (Back)')">
                    </div>
                </div>
            </div>
        </div>

        <div class="action-buttons">
            <a href="{{ route('admin.vendors') }}" class="btn back-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Back to List
            </a>

            @if($vendor->status === 'pending')
                <form action="{{ route('admin.approveVendor', $vendor->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><path d="M20 6L9 17l-5-5"/></svg>
                        Approve Vendor
                    </button>
                </form>
            @elseif($vendor->status === 'approved')
                <form action="{{ route('admin.rejectVendor', $vendor->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn danger-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><path d="M18 6L6 18M6 6l12 12"/></svg>
                        Reject Vendor
                    </button>
                </form>
            @else
                <form action="{{ route('admin.pendingVendor', $vendor->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 8px;"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                        Mark as Pending
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-content-wrapper">
            <img class="modal-content" id="modalImage">
        </div>
        <div class="modal-controls">
            <div class="zoom-controls">
                <button class="zoom-btn" onclick="zoomIn()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="11" y1="8" x2="11" y2="14"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                </button>
                <button class="zoom-btn" onclick="zoomOut()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/><line x1="8" y1="11" x2="14" y2="11"/></svg>
                </button>
                <button class="zoom-btn" onclick="resetZoom()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 2v6h6"/><path d="M21 12A9 9 0 0 0 6 5.3L3 8"/><path d="M21 22v-6h-6"/><path d="M3 12a9 9 0 0 0 15 6.7l3-2.7"/></svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        let currentZoom = 1;

        function openModal(imageSrc, title) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImage');

            modal.style.display = "block";
            modalImg.src = imageSrc;
            modalImg.alt = title || '';

            // Reset zoom when opening new image
            resetZoom();

            // Prevent scrolling when modal is open
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('imageModal').style.display = "none";
            // Re-enable scrolling
            document.body.style.overflow = 'auto';
        }

        function zoomIn() {
            currentZoom += 0.25;
            if (currentZoom > 3) currentZoom = 3; // Max zoom
            applyZoom();
        }

        function zoomOut() {
            currentZoom -= 0.25;
            if (currentZoom < 0.5) currentZoom = 0.5; // Min zoom
            applyZoom();
        }

        function resetZoom() {
            currentZoom = 1;
            applyZoom();
        }

        function applyZoom() {
            const modalImg = document.getElementById('modalImage');
            modalImg.style.transform = `scale(${currentZoom})`;
            modalImg.style.transition = 'transform 0.3s ease';
        }

        // Close modal when clicking outside the image
        window.onclick = function(event) {
            const modal = document.getElementById('imageModal');
            if (event.target == modal) {
                closeModal();
            }
        }

        // Close modal with escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>

@endsection
