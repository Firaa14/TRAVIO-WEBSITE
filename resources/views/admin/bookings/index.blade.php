@extends('admin.layouts.app')

@section('title', 'Manajemen Booking')
@section('page-title', 'Manajemen Booking')

@section('content')
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $allBookings->where('type', 'car')->count() }}</h4>
                        <p class="mb-0">Booking Mobil</p>
                    </div>
                    <i class="fas fa-car fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $allBookings->where('type', 'destination')->count() }}</h4>
                        <p class="mb-0">Booking Destination</p>
                    </div>
                    <i class="fas fa-mountain fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $allBookings->where('type', 'hotel')->count() }}</h4>
                        <p class="mb-0">Booking Hotel</p>
                    </div>
                    <i class="fas fa-hotel fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4>{{ $allBookings->where('type', 'package')->count() }}</h4>
                        <p class="mb-0">Booking Paket</p>
                    </div>
                    <i class="fas fa-box fa-2x opacity-50"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fas fa-calendar-check me-2"></i>Semua Booking</h5>
    </div>
    <div class="card-body">
        @if($allBookings->count() > 0)
        <div class="table-responsive">
            <table class="table table-hover data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tipe</th>
                        <th>User</th>
                        <th>Item</th>
                        <th>Total Harga</th>
                        <th>Status</th>
                        <th>Tanggal Booking</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allBookings as $index => $booking)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @switch($booking->type)
                                @case('car')
                                    <span class="badge bg-primary">Mobil</span>
                                    @break
                                @case('destination')
                                    <span class="badge bg-success">Destination</span>
                                    @break
                                @case('hotel')
                                    <span class="badge bg-warning">Hotel</span>
                                    @break
                                @case('package')
                                    <span class="badge bg-info">Paket</span>
                                    @break
                            @endswitch
                        </td>
                        <td>{{ $booking->user->name ?? 'N/A' }}</td>
                        <td>{{ Str::limit($booking->item_name, 30) }}</td>
                        <td>Rp {{ number_format($booking->total_price, 0, ',', '.') }}</td>
                        <td>
                            <select class="form-select form-select-sm status-select" 
                                    data-booking-id="{{ $booking->id }}" 
                                    data-booking-type="{{ $booking->type }}">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </td>
                        <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button class="btn btn-sm btn-info view-detail" data-booking="{{ json_encode($booking) }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-5">
            <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada booking</h5>
            <p class="text-muted">Booking akan muncul di sini setelah user melakukan pemesanan</p>
        </div>
        @endif
    </div>
</div>

<!-- Modal Detail Booking -->
<div class="modal fade" id="bookingDetailModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="bookingDetailContent">
                <!-- Content will be loaded dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.data-table').DataTable({
        responsive: true,
        pageLength: 10,
        order: [[6, 'desc']],
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json'
        }
    });

    // Handle status change
    $('.status-select').on('change', function() {
        const bookingId = $(this).data('booking-id');
        const bookingType = $(this).data('booking-type');
        const newStatus = $(this).val();
        const selectElement = $(this);

        // Confirm the change
        if (confirm(`Yakin ingin mengubah status booking menjadi ${newStatus}?`)) {
            $.ajax({
                url: `/admin/bookings/${bookingType}/${bookingId}/status`,
                method: 'PATCH',
                data: {
                    status: newStatus,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.success) {
                        // Show success message
                        const alertDiv = `
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>${response.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        `;
                        $('.content-wrapper').prepend(alertDiv);
                        
                        // Auto remove alert after 5 seconds
                        setTimeout(function() {
                            $('.alert').fadeOut();
                        }, 5000);
                    }
                },
                error: function(xhr) {
                    console.error('Error updating status:', xhr);
                    alert('Gagal mengubah status. Silakan coba lagi.');
                    // Revert the select back to original value
                    selectElement.val(selectElement.data('original-value'));
                }
            });
        } else {
            // User cancelled, revert the select
            selectElement.val(selectElement.data('original-value'));
        }
    });

    // Store original values
    $('.status-select').each(function() {
        $(this).data('original-value', $(this).val());
    });

    // Handle view detail
    $('.view-detail').on('click', function() {
        const booking = $(this).data('booking');
        let content = `
            <div class="row">
                <div class="col-md-6">
                    <h6>Informasi Booking</h6>
                    <table class="table table-sm">
                        <tr><td>ID Booking</td><td>: ${booking.id}</td></tr>
                        <tr><td>Tipe</td><td>: ${booking.type}</td></tr>
                        <tr><td>Status</td><td>: <span class="badge bg-${booking.status == 'confirmed' ? 'success' : (booking.status == 'cancelled' ? 'danger' : 'warning')}">${booking.status}</span></td></tr>
                        <tr><td>Tanggal Booking</td><td>: ${new Date(booking.created_at).toLocaleDateString('id-ID')}</td></tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <h6>Informasi User</h6>
                    <table class="table table-sm">
                        <tr><td>Nama</td><td>: ${booking.user ? booking.user.name : 'N/A'}</td></tr>
                        <tr><td>Email</td><td>: ${booking.user ? booking.user.email : 'N/A'}</td></tr>
                        <tr><td>Item</td><td>: ${booking.item_name}</td></tr>
                        <tr><td>Total Harga</td><td>: Rp ${new Intl.NumberFormat('id-ID').format(booking.total_price)}</td></tr>
                    </table>
                </div>
            </div>
        `;
        
        $('#bookingDetailContent').html(content);
        $('#bookingDetailModal').modal('show');
    });
});
</script>
@endpush