@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard Admin')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card text-center" style="border-left-color: var(--primary-color);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="text-primary">{{ $bookingStats['car_bookings']['total'] ?? 0 }}</h3>
                    <p class="mb-0 text-muted">Total Booking Mobil</p>
                    <small class="text-success">{{ $bookingStats['car_bookings']['today'] ?? 0 }} hari ini</small>
                </div>
                <i class="fas fa-car stat-icon text-primary"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card text-center" style="border-left-color: var(--success-color);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="text-success">{{ $bookingStats['destination_bookings']['total'] ?? 0 }}</h3>
                    <p class="mb-0 text-muted">Total Booking Destination</p>
                    <small class="text-success">{{ $bookingStats['destination_bookings']['today'] ?? 0 }} hari ini</small>
                </div>
                <i class="fas fa-mountain stat-icon text-success"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card text-center" style="border-left-color: var(--warning-color);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="text-warning">{{ $bookingStats['hotel_bookings']['total'] ?? 0 }}</h3>
                    <p class="mb-0 text-muted">Total Booking Hotel</p>
                    <small class="text-success">{{ $bookingStats['hotel_bookings']['today'] ?? 0 }} hari ini</small>
                </div>
                <i class="fas fa-hotel stat-icon text-warning"></i>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="stat-card text-center" style="border-left-color: var(--danger-color);">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h3 class="text-danger">{{ $bookingStats['package_bookings']['total'] ?? 0 }}</h3>
                    <p class="mb-0 text-muted">Total Booking Paket</p>
                    <small class="text-success">{{ $bookingStats['package_bookings']['today'] ?? 0 }} hari ini</small>
                </div>
                <i class="fas fa-box stat-icon text-danger"></i>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Status Overview -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Status Booking Overview</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 text-center mb-3">
                        <h4 class="text-warning">
                            {{ ($bookingStats['car_bookings']['pending'] ?? 0) + 
                               ($bookingStats['destination_bookings']['pending'] ?? 0) + 
                               ($bookingStats['hotel_bookings']['pending'] ?? 0) + 
                               ($bookingStats['package_bookings']['pending'] ?? 0) }}
                        </h4>
                        <p class="mb-0 text-muted">Pending</p>
                    </div>
                    <div class="col-md-3 text-center mb-3">
                        <h4 class="text-success">
                            {{ ($bookingStats['car_bookings']['confirmed'] ?? 0) + 
                               ($bookingStats['destination_bookings']['confirmed'] ?? 0) + 
                               ($bookingStats['hotel_bookings']['confirmed'] ?? 0) + 
                               ($bookingStats['package_bookings']['confirmed'] ?? 0) }}
                        </h4>
                        <p class="mb-0 text-muted">Dikonfirmasi</p>
                    </div>
                    <div class="col-md-3 text-center mb-3">
                        <h4 class="text-danger">
                            {{ ($bookingStats['car_bookings']['cancelled'] ?? 0) + 
                               ($bookingStats['destination_bookings']['cancelled'] ?? 0) + 
                               ($bookingStats['hotel_bookings']['cancelled'] ?? 0) + 
                               ($bookingStats['package_bookings']['cancelled'] ?? 0) }}
                        </h4>
                        <p class="mb-0 text-muted">Dibatalkan</p>
                    </div>
                    <div class="col-md-3 text-center mb-3">
                        <h4 class="text-info">
                            Rp {{ number_format(array_sum($revenue ?? []), 0, ',', '.') }}
                        </h4>
                        <p class="mb-0 text-muted">Total Revenue</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Bookings -->
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-car me-2"></i>Booking Mobil Terbaru</h5>
            </div>
            <div class="card-body">
                @if(isset($recentBookings['car']) && $recentBookings['car']->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Mobil</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings['car'] as $booking)
                                <tr>
                                    <td>{{ $booking->user->name ?? 'Guest' }}</td>
                                    <td>{{ isset($booking->car->title) ? Str::limit($booking->car->title, 20) : 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-{{ ($booking->status ?? 'pending') == 'confirmed' ? 'success' : (($booking->status ?? 'pending') == 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($booking->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">Belum ada booking mobil</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-hotel me-2"></i>Booking Hotel Terbaru</h5>
            </div>
            <div class="card-body">
                @if(isset($recentBookings['hotel']) && $recentBookings['hotel']->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Hotel</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings['hotel'] as $booking)
                                <tr>
                                    <td>{{ $booking->user->name ?? 'Guest' }}</td>
                                    <td>N/A</td>
                                    <td>
                                        <span class="badge badge-{{ ($booking->status ?? 'pending') == 'confirmed' ? 'success' : (($booking->status ?? 'pending') == 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($booking->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">Belum ada booking hotel</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-mountain me-2"></i>Booking Destination Terbaru</h5>
            </div>
            <div class="card-body">
                @if(isset($recentBookings['destination']) && $recentBookings['destination']->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Destination</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings['destination'] as $booking)
                                <tr>
                                    <td>{{ $booking->user->name ?? 'Guest' }}</td>
                                    <td>{{ isset($booking->destination->name) ? Str::limit($booking->destination->name, 20) : 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-{{ ($booking->status ?? 'pending') == 'confirmed' ? 'success' : (($booking->status ?? 'pending') == 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($booking->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">Belum ada booking destination</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-box me-2"></i>Booking Paket Terbaru</h5>
            </div>
            <div class="card-body">
                @if(isset($recentBookings['package']) && $recentBookings['package']->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Paket</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBookings['package'] as $booking)
                                <tr>
                                    <td>{{ $booking->user->name ?? 'Guest' }}</td>
                                    <td>{{ isset($booking->package->name) ? Str::limit($booking->package->name, 20) : 'N/A' }}</td>
                                    <td>
                                        <span class="badge badge-{{ ($booking->status ?? 'pending') == 'confirmed' ? 'success' : (($booking->status ?? 'pending') == 'cancelled' ? 'danger' : 'warning') }}">
                                            {{ ucfirst($booking->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td>Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted text-center">Belum ada booking paket</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2 text-center mb-3">
                        <a href="{{ route('admin.bookings.index') }}" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-calendar-check d-block mb-2"></i>
                            <small>Kelola Booking</small>
                        </a>
                    </div>
                    <div class="col-md-2 text-center mb-3">
                        <a href="{{ route('admin.car.create') }}" class="btn btn-success btn-lg w-100">
                            <i class="fas fa-plus d-block mb-2"></i>
                            <small>Tambah Mobil</small>
                        </a>
                    </div>
                    <div class="col-md-2 text-center mb-3">
                        <a href="{{ route('admin.hotel.create') }}" class="btn btn-warning btn-lg w-100">
                            <i class="fas fa-plus d-block mb-2"></i>
                            <small>Tambah Hotel</small>
                        </a>
                    </div>
                    <div class="col-md-2 text-center mb-3">
                        <a href="{{ route('admin.destination.create') }}" class="btn btn-info btn-lg w-100">
                            <i class="fas fa-plus d-block mb-2"></i>
                            <small>Tambah Destination</small>
                        </a>
                    </div>
                    <div class="col-md-2 text-center mb-3">
                        <a href="{{ route('admin.package.create') }}" class="btn btn-secondary btn-lg w-100">
                            <i class="fas fa-plus d-block mb-2"></i>
                            <small>Tambah Paket</small>
                        </a>
                    </div>
                    <div class="col-md-2 text-center mb-3">
                        <a href="{{ route('admin.destinasi.create') }}" class="btn btn-dark btn-lg w-100">
                            <i class="fas fa-plus d-block mb-2"></i>
                            <small>Tambah Destinasi</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection