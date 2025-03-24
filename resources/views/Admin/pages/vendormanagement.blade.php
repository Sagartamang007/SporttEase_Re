@extends('admin.layouts.app')

@section('content')
<style>
    /* SportEase Admin Vendor Applications Styles */

    /* Page heading */
    h2 {
        color: #2c3e50;
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 25px;
        padding-bottom: 15px;
        border-bottom: 2px solid rgba(44, 62, 80, 0.1);
        position: relative;
    }

    h2:after {
        content: "";
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 60px;
        height: 2px;
        background-color: #3498db;
    }

    /* Success and error messages */
    .alert-success {
        background-color: rgba(46, 204, 113, 0.1);
        border-left: 4px solid #2ecc71;
        color: #27ae60;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    .alert-error {
        background-color: rgba(231, 76, 60, 0.1);
        border-left: 4px solid #e74c3c;
        color: #c0392b;
        padding: 15px;
        border-radius: 6px;
        margin-bottom: 20px;
        font-weight: 600;
    }

    /* Table container */
    .table-container {
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 30px;
        width: 100%;
    }

    /* Table */
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 15px;
    }

    thead {
        background-color: #f8f9fa;
        border-bottom: 2px solid #eaeaea;
    }

    th {
        padding: 16px;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 13px;
        border: none;
    }

    tbody tr {
        border-bottom: 1px solid #eaeaea;
        transition: all 0.2s ease;
    }

    tbody tr:last-child {
        border-bottom: none;
    }

    tbody tr:hover {
        background-color: rgba(52, 152, 219, 0.05);
    }

    td {
        padding: 16px;
        vertical-align: middle;
        border: none;
    }

    /* Status Badges */
    .status-badge {
        padding: 6px 12px;
        border-radius: 50px;
        font-size: 13px;
        font-weight: 600;
        text-transform: capitalize;
    }

    .status-pending { background-color: rgba(243, 156, 18, 0.1); color: #f39c12; }
    .status-approved { background-color: rgba(46, 204, 113, 0.1); color: #2ecc71; }
    .status-rejected { background-color: rgba(231, 76, 60, 0.1); color: #e74c3c; }

    /* Image Styling */
    .vendor-doc img {
        width: 80px;
        height: auto;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
        cursor: pointer;
    }

    .vendor-doc img:hover {
        transform: scale(1.1);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }

    /* Action Buttons */
    button {
        padding: 8px 14px;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
    }

    .approve-btn {
        background-color: #2ecc71;
        color: white;
    }

    .approve-btn:hover {
        background-color: #27ae60;
    }

    .reject-btn {
        background-color: #e74c3c;
        color: white;
    }

    .reject-btn:hover {
        background-color: #c0392b;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        table, thead, tbody, th, td, tr {
            display: block;
        }

        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            background-color: white;
            margin-bottom: 15px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        td {
            position: relative;
            padding: 12px;
            text-align: right;
        }

        td:before {
            position: absolute;
            top: 12px;
            left: 12px;
            font-weight: 600;
            color: #2c3e50;
            text-align: left;
        }

        td:nth-of-type(1):before { content: "Name"; }
        td:nth-of-type(2):before { content: "Company"; }
        td:nth-of-type(3):before { content: "PAN Card"; }
        td:nth-of-type(4):before { content: "Citizenship"; }
        td:nth-of-type(5):before { content: "Status"; }
        td:nth-of-type(6):before { content: "Actions"; }

        button {
            width: 100%;
        }
    }
</style>

<h2>Vendor Applications</h2>

@if(session('success'))
    <p class="alert-success">{{ session('success') }}</p>
@endif
@if(session('error'))
    <p class="alert-error">{{ session('error') }}</p>
@endif

<div class="table-container">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Company</th>
                <th>PAN Card</th>
                <th>Citizenship</th>
                <th>Status</th>

            </tr>
        </thead>
        <tbody>
            @foreach($vendors as $vendor)
<tr class="vendor-row" data-href="{{ route('admin.vendors.show', ['id' => $vendor->id]) }}">
    <td>
        <a href="{{ route('admin.vendors.show', ['id' => $vendor->id]) }}" class="vendor-link">
            {{ $vendor->name }}
        </a>
    </td>
    <td>{{ $vendor->company_name }}</td>
    <td class="vendor-doc">
        <img src="{{ asset('storage/' . $vendor->pan_card_image) }}" alt="PAN Card">
    </td>
    <td class="vendor-doc">
        <img src="{{ asset('storage/' . $vendor->front_citizenship_document) }}" alt="Front Citizenship">
        <img src="{{ asset('storage/' . $vendor->back_citizenship_document) }}" alt="Back Citizenship">
    </td>
    <td>
        <span class="status-badge status-{{ $vendor->status }}">
            {{ ucfirst($vendor->status) }}
        </span>
    </td>
</tr>
@endforeach

<script>
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".vendor-row").forEach(row => {
            row.addEventListener("click", function () {
                window.location.href = this.getAttribute("data-href");
            });
        });
    });
</script>

        </tbody>

    </table>
</div>
@endsection
