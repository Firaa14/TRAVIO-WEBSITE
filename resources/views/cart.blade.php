@extends('layouts.app')
@section('title', 'Keranjang | Travio')

@section('content')
@include('components.carthero')
@php
    $hideNavbar = true; // sembunyikan navbar jika diperlukan
    $activeTab = $activeTab ?? 'details';
@endphp

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('resources/css/cart-custom.css') }}" rel="stylesheet">

    <div class="container py-5" style="font-family: 'Poppins', sans-serif; min-height: 100vh;">
        <h2 class="mb-4 fw-bold text-center" style="color: #1565c0; letter-spacing: 1px;">Keranjang Pemesanan Anda</h2>
        <form id="cartForm" method="POST" action="{{ route('cart.checkout') }}">
            @csrf
            <div class="card shadow-lg border-0 rounded-4 mb-4">
                <div class="card-body" style="border-radius: 1rem;">
                    @if(count($items) > 0)
                        <div class="table-responsive">
                            <table class="table table-hover align-middle" style="font-size: 1.05rem;">
                                <thead style="background: #e3f0ff;">
                                    <tr>
                                        <th class="text-center">Pilih</th>
                                        <th>Gambar</th>
                                        <th>Nama & Tipe</th>
                                        <th class="text-end">Harga</th>
                                        <th class="text-center">Jumlah</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        <tr>
                                            <td class="text-center">
                                                <input type="checkbox" name="selected[]" value="{{ $item['id'] }}"
                                                    class="form-check-input item-check" style="accent-color: #1976d2;">
                                            </td>
                                            <td style="width:100px">
                                                <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}"
                                                    class="img-fluid rounded shadow-sm"
                                                    style="height: 70px; width: 100px; object-fit: cover; border: 2px solid #90caf9;">
                                            </td>
                                            <td>
                                                <span class="fw-bold" style="color: #1976d2;">{{ $item['nama'] }}</span><br>
                                                <span class="badge"
                                                    style="background: #bbdefb; color: #1565c0; font-weight: 600;">{{ $item['tipe'] }}</span>
                                            </td>
                                            <td class="text-end">
                                                <span class="fw-bold"
                                                    style="color: #1976d2;">Rp{{ number_format($item['harga'], 0, ',', '.') }}</span>
                                            </td>
                                            <td class="text-center">
                                                <input type="number" min="1" value="{{ $item['jumlah'] }}"
                                                    class="form-control text-center item-qty"
                                                    style="width:70px; margin:auto; border: 2px solid #90caf9; border-radius: 0.5rem;">
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-outline-danger"
                                                    style="border-radius: 0.5rem; transition: background 0.2s;">Hapus</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-warning text-center mb-0" style="font-family: 'Poppins', sans-serif;">Keranjang
                            Anda kosong. Silakan pilih produk atau layanan terlebih dahulu.</div>
                    @endif
                </div>
            </div>

            <!-- Total Section -->
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-center"
                    style="border-radius: 1rem;">
                    <div class="mb-2 mb-md-0">
                        <input type="checkbox" id="selectAll" class="form-check-input me-2" style="accent-color: #1976d2;">
                        <label for="selectAll" class="fw-semibold" style="color: #1976d2;">Pilih Semua</label>
                    </div>
                    <h4 class="mb-0" style="color: #1976d2;">Total: <span id="totalHarga" class="fw-bold"
                            style="color: #388e3c;">Rp0</span></h4>
                    <a href="#" id="checkoutBtn" class="btn btn-lg px-5 py-2 fw-bold shadow"
                        style="background: linear-gradient(90deg, #1976d2 60%, #64b5f6 100%); color: #fff; border: none; border-radius: 0.7rem; transition: background 0.2s;">Checkout</a>
                </div>
            </div>
        </form>

        <!-- Modal Bukti Pembayaran -->
        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="font-family: 'Poppins', sans-serif;">
                    <div class="modal-header"
                        style="background: linear-gradient(90deg, #1976d2 60%, #64b5f6 100%); color: #fff;">
                        <h5 class="modal-title fw-bold" id="paymentModalLabel">Upload Bukti Pembayaran</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label fw-semibold" style="color: #1976d2;">Nomor WhatsApp Admin</label>
                            <div class="alert alert-info d-flex align-items-center"
                                style="color: #1976d2; border: 1px solid #90caf9;">
                                <i class="bi bi-whatsapp me-2 fs-4"></i>
                                <span class="fw-bold fs-5">+62 812-3456-7890</span>
                            </div>
                            <small class="text-muted">Silakan transfer sesuai total dan kirim bukti ke WhatsApp admin di
                                atas.</small>
                        </div>
                        <form id="buktiForm" method="POST" action="{{ route('cart.uploadBukti') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="color: #1976d2;">Upload Bukti
                                    Pembayaran</label>
                                <input type="file" name="bukti_pembayaran" class="form-control border-primary"
                                    style="border: 2px solid #90caf9; border-radius: 0.5rem;"
                                    accept="image/*,application/pdf" required>
                                <small class="text-muted">Format: JPG, PNG, PDF. Maksimal 5MB.</small>
                            </div>
                            <button type="submit" class="btn w-100 py-2 mt-2 rounded-3 fw-bold shadow-sm"
                                style="background: linear-gradient(90deg, #1976d2 60%, #64b5f6 100%); color: #fff; border: none;">
                                <i class="bi bi-upload me-2"></i> Submit &amp; Dapatkan Invoice </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.item-check');
            const qtyInputs = document.querySelectorAll('.item-qty');
            const totalHarga = document.getElementById('totalHarga');
            const selectAll = document.getElementById('selectAll');
            const checkoutBtn = document.getElementById('checkoutBtn');

            function updateTotal() {
                let total = 0;
                checkboxes.forEach((cb, i) => {
                    if (cb.checked) {
                        const harga = parseInt({!! json_encode(array_column($items, 'harga')) !!}[i]);
                        const qty = parseInt(qtyInputs[i].value);
                        total += harga * qty;
                    }
                });
                totalHarga.textContent = 'Rp' + total.toLocaleString('id-ID');
            }

            checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));
            qtyInputs.forEach(inp => inp.addEventListener('change', updateTotal));
            selectAll.addEventListener('change', function () {
                checkboxes.forEach(cb => cb.checked = selectAll.checked);
                updateTotal();
            });

            checkoutBtn.addEventListener('click', function (e) {
                e.preventDefault();
                // Ambil item pertama yang dicentang
                let selected = null;
                checkboxes.forEach((cb, i) => {
                    if (cb.checked && !selected) {
                        selected = cb.value;
                    }
                });
                if (selected) {
                    checkoutBtn.classList.add('disabled');
                    checkoutBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Loading...';
                    setTimeout(function () {
                        window.location.href = '/checkout/' + selected;
                    }, 700);
                } else {
                    checkoutBtn.classList.add('shake');
                    setTimeout(function () { checkoutBtn.classList.remove('shake'); }, 500);
                    alert('Pilih minimal satu item untuk checkout!');
                }
            });
        });
    </script>
    <style>
        body,
        .container,
        .card,
        .modal-content {
            font-family: 'Poppins', sans-serif !important;
        }

        .card,
        .modal-content {
            box-shadow: 0 4px 24px rgba(21, 101, 192, 0.08);
        }

        .btn-success,
        .btn-primary,
        .btn-lg {
            background: linear-gradient(90deg, #1976d2 60%, #64b5f6 100%);
            color: #fff;
            border: none;
        }

        .btn-success:hover,
        .btn-primary:hover,
        .btn-lg:hover {
            background: linear-gradient(90deg, #1565c0 60%, #1976d2 100%);
            color: #fff;
        }

        .btn-outline-danger {
            border-color: #1976d2;
            color: #1976d2;
        }

        .btn-outline-danger:hover {
            background: #1976d2;
            color: #fff;
        }

        .form-control:focus {
            border-color: #1976d2;
            box-shadow: 0 0 0 0.2rem #90caf9;
        }

        .table-hover tbody tr:hover {
            background: #e3f0ff;
            transition: background 0.2s;
        }

        .shake {
            animation: shake 0.3s;
        }

        @keyframes shake {
            0% {
                transform: translateX(0);
            }

            25% {
                transform: translateX(-5px);
            }

            50% {
                transform: translateX(5px);
            }

            75% {
                transform: translateX(-5px);
            }

            100% {
                transform: translateX(0);
            }
        }
    </style>
@endsection