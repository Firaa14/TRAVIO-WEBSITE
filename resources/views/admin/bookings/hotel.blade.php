@extends('admin.layouts.app')

@section('title', 'Booking Hotel')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Booking Hotel</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.bookings.index') }}">Manajemen Booking</a></li>
                    <li class="breadcrumb-item active">Booking Hotel</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Booking Hotel</h3>
                <div class="card-tools">
                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali ke Semua Booking
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                @if($bookings->count() > 0)
                    <div class="table-responsive">
                        <table id="bookingTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal Booking</th>
                                    <th>Customer</th>
                                    <th>Hotel</th>
                                    <th>Kamar</th>
                                    <th>Check-in</th>
                                    <th>Check-out</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $index => $booking)
                                    <tr>
                                        <td>{{ $bookings->firstItem() + $index }}</td>
                                        <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
                                        <td>
                                            <strong>{{ $booking->user->name ?? 'N/A' }}</strong><br>
                                            <small class="text-muted">{{ $booking->user->email ?? 'N/A' }}</small>
                                        </td>
                                        <td>{{ $booking->hotelDetail->nama ?? 'N/A' }}</td>
                                        <td>{{ $booking->hotelRoom->name ?? 'N/A' }}</td>
                                        <td>{{ $booking->check_in_date ? date('d M Y', strtotime($booking->check_in_date)) : 'N/A' }}</td>
                                        <td>{{ $booking->check_out_date ? date('d M Y', strtotime($booking->check_out_date)) : 'N/A' }}</td>
                                        <td>Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</td>
                                        <td>
                                            <select class="form-control form-control-sm status-select" 
                                                    data-type="hotel" 
                                                    data-id="{{ $booking->id }}"
                                                    data-current="{{ $booking->status }}">
                                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailModal{{ $booking->id }}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="d-flex justify-content-center mt-4">
                        {{ $bookings->links() }}
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h5 class="text-muted">Belum ada booking hotel</h5>
                        <p class="text-muted">Booking hotel akan muncul di sini ketika ada customer yang melakukan pemesanan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@foreach($bookings as $booking)
<!-- Detail Modal -->
<div class="modal fade" id="detailModal{{ $booking->id }}" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Booking Hotel</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th>Customer:</th>
                                <td>{{ $booking->user->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $booking->user->email ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Hotel:</th>
                                <td>{{ $booking->hotelDetail->nama ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Kamar:</th>
                                <td>{{ $booking->hotelRoom->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Booking:</th>
                                <td>{{ $booking->created_at->format('d M Y H:i') }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <th>Check-in:</th>
                                <td>{{ $booking->check_in_date ? date('d M Y', strtotime($booking->check_in_date)) : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Check-out:</th>
                                <td>{{ $booking->check_out_date ? date('d M Y', strtotime($booking->check_out_date)) : 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Jumlah Tamu:</th>
                                <td>{{ $booking->num_guests ?? 'N/A' }} orang</td>
                            </tr>
                            <tr>
                                <th>Total Harga:</th>
                                <td>Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Status:</th>
                                <td>
                                    @if($booking->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($booking->status == 'confirmed')
                                        <span class="badge badge-success">Confirmed</span>
                                    @else
                                        <span class="badge badge-danger">Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                
                @if($booking->special_requests)
                <hr>
                <div class="row">
                    <div class="col-12">
                        <h6>Permintaan Khusus:</h6>
                        <p>{{ $booking->special_requests }}</p>
                    </div>
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script>
$(function () {
    $("#bookingTable").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "searching": true,
        "paging": false,
        "info": false
    });

    // Handle status change
    $('.status-select').on('change', function() {
        const select = $(this);
        const type = select.data('type');
        const id = select.data('id');
        const currentStatus = select.data('current');
        const newStatus = select.val();
        
        if (newStatus === currentStatus) return;
        
        if (!confirm(`Yakin ingin mengubah status booking menjadi ${newStatus}?`)) {
            select.val(currentStatus);
            return;
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url: `/admin/bookings/${type}/${id}/status`,
            method: 'PATCH',
            data: {
                status: newStatus
            },
            success: function(response) {
                if (response.success) {
                    select.data('current', newStatus);
                    
                    // Show toast notification
                    $('body').append(`
                        <div class="toast" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
                            <div class="toast-header">
                                <strong class="mr-auto text-success">Sukses</strong>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">
                                    <span>&times;</span>
                                </button>
                            </div>
                            <div class="toast-body">
                                ${response.message}
                            </div>
                        </div>
                    `);
                    $('.toast').toast({delay: 3000}).toast('show');
                    
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alert('Gagal mengubah status: ' + response.message);
                    select.val(currentStatus);
                }
            },
            error: function(xhr) {
                alert('Terjadi kesalahan saat mengubah status');
                select.val(currentStatus);
            }
        });
    });
});
</script>
@endpush