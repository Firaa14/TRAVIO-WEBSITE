<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History - {{ $user->name }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #0088FF;
        }

        .header h1 {
            color: #0088FF;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .user-info {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .user-info h3 {
            color: #0088FF;
            margin-bottom: 15px;
            font-size: 16px;
        }

        .user-info table {
            width: 100%;
        }

        .user-info td {
            padding: 5px 0;
        }

        .user-info td:first-child {
            width: 120px;
            font-weight: bold;
            color: #555;
        }

        .bookings-section {
            margin-top: 30px;
        }

        .bookings-section h3 {
            color: #0088FF;
            margin-bottom: 20px;
            font-size: 18px;
            padding-bottom: 10px;
            border-bottom: 2px solid #0088FF;
        }

        .booking-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .booking-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .booking-type {
            display: inline-block;
            background: #6c757d;
            color: white;
            padding: 4px 10px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
            margin-right: 10px;
        }

        .booking-title {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .booking-status {
            display: inline-block;
            background: #0088FF;
            color: white;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }

        .booking-status.pending {
            background: #ffc107;
        }

        .booking-status.completed {
            background: #28a745;
        }

        .booking-status.cancelled {
            background: #dc3545;
        }

        .booking-details {
            display: table;
            width: 100%;
        }

        .booking-details .row {
            display: table-row;
        }

        .booking-details .row>div {
            display: table-cell;
            padding: 5px 0;
        }

        .booking-details .label {
            width: 100px;
            color: #666;
            font-size: 11px;
        }

        .booking-details .value {
            color: #333;
            font-weight: 500;
        }

        .booking-price {
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            text-align: right;
        }

        .price-label {
            color: #666;
            font-size: 11px;
        }

        .price-value {
            color: #0088FF;
            font-size: 16px;
            font-weight: bold;
        }

        .summary {
            margin-top: 30px;
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .summary h4 {
            color: #0088FF;
            margin-bottom: 15px;
        }

        .summary-stats {
            display: flex;
            justify-content: space-around;
            margin-top: 15px;
        }

        .stat-item {
            text-align: center;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #0088FF;
        }

        .stat-label {
            font-size: 11px;
            color: #666;
            margin-top: 5px;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 10px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }

        .no-bookings {
            text-align: center;
            padding: 40px;
            color: #999;
        }

        @media print {
            body {
                padding: 0;
            }

            .booking-item {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🧳 TRAVIO - Booking History</h1>
        <p>Complete Travel Booking Report</p>
    </div>

    <div class="user-info">
        <h3>👤 Customer Information</h3>
        <table>
            <tr>
                <td>Name:</td>
                <td>{{ $user->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>Username:</td>
                <td>{{ $user->username ?? '-' }}</td>
            </tr>
            <tr>
                <td>Email:</td>
                <td>{{ $user->email ?? '-' }}</td>
            </tr>
            <tr>
                <td>Phone:</td>
                <td>{{ $user->phone ?? 'Not set' }}</td>
            </tr>
            <tr>
                <td>Report Date:</td>
                <td>{{ date('d F Y, H:i') }}</td>
            </tr>
        </table>
    </div>

    <div class="bookings-section">
        <h3>📋 Booking History ({{ count($bookings) }} bookings)</h3>

        @if(count($bookings) > 0)
            @foreach($bookings as $index => $booking)
                <div class="booking-item">
                    <div class="booking-header">
                        <div>
                            <span class="booking-type">{{ $booking['type'] }}</span>
                            <span class="booking-title">{{ $booking['title'] }}</span>
                        </div>
                        <span class="booking-status {{ strtolower($booking['status']) }}">
                            {{ $booking['status'] }}
                        </span>
                    </div>

                    <div class="booking-details">
                        <div class="row">
                            <div class="label">📍 Location:</div>
                            <div class="value">{{ $booking['location'] }}</div>
                        </div>
                        <div class="row">
                            <div class="label">📅 Booking Date:</div>
                            <div class="value">{{ $booking['date'] }}</div>
                        </div>
                        <div class="row">
                            <div class="label">ℹ️ Details:</div>
                            <div class="value">{{ $booking['details'] }}</div>
                        </div>
                    </div>

                    <div class="booking-price">
                        <span class="price-label">Total Price: </span>
                        <span class="price-value">Rp{{ number_format($booking['price'], 0, ',', '.') }}</span>
                    </div>
                </div>
            @endforeach

            <div class="summary">
                <h4>📊 Booking Summary</h4>
                <div class="summary-stats">
                    <div class="stat-item">
                        <div class="stat-value">{{ count($bookings) }}</div>
                        <div class="stat-label">Total Bookings</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">
                            {{ count(array_filter($bookings->toArray(), fn($b) => strtolower($b['status']) == 'completed')) }}
                        </div>
                        <div class="stat-label">Completed</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">
                            {{ count(array_filter($bookings->toArray(), fn($b) => strtolower($b['status']) == 'pending')) }}
                        </div>
                        <div class="stat-label">Pending</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">
                            Rp{{ number_format(array_sum(array_column($bookings->toArray(), 'price')), 0, ',', '.') }}</div>
                        <div class="stat-label">Total Spent</div>
                    </div>
                </div>
            </div>
        @else
            <div class="no-bookings">
                <p>📭 No booking history found.</p>
            </div>
        @endif
    </div>

    <div class="footer">
        <p>This is an automatically generated document from TRAVIO Travel System</p>
        <p>Generated on {{ date('d F Y, H:i:s') }} | © 2025 TRAVIO - Your Travel Partner</p>
    </div>
</body>

</html>