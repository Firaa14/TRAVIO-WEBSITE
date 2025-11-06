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

    <div class="container py-5">
        <h3 class="mb-4 fw-bold">Keranjang Saya</h3>

        <form id="cartForm" method="POST" action="{{ route('cart.checkout') }}">
            @csrf
            <div class="card shadow-sm">
                <div class="card-body">
                    @foreach($items as $item)
                        <div class="row align-items-center border-bottom py-3">
                            <div class="col-md-1 text-center">
                                <input type="checkbox" name="selected[]" value="{{ $item['id'] }}"
                                    class="form-check-input item-check">
                            </div>
                            <div class="col-md-2">
                                <img src="{{ asset($item['gambar']) }}" alt="{{ $item['nama'] }}" class="img-fluid rounded"
                                    style="height: 80px; width: 100%; object-fit: cover;">
                            </div>
                            <div class="col-md-4">
                                <h6 class="mb-1">{{ $item['nama'] }}</h6>
                                <small class="text-muted">{{ $item['tipe'] }}</small>
                            </div>
                            <div class="col-md-2 text-end">
                                Rp{{ number_format($item['harga'], 0, ',', '.') }}
                            </div>
                            <div class="col-md-2 text-center">
                                <input type="number" min="1" value="{{ $item['jumlah'] }}"
                                    class="form-control text-center item-qty" style="width:80px; margin:auto;">
                            </div>
                            <div class="col-md-1 text-center">
                                <a href="#" class="text-danger small text-decoration-none">Hapus</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Total Section -->
            <div class="card mt-4 shadow-sm">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <input type="checkbox" id="selectAll" class="form-check-input me-2">
                        <label for="selectAll">Pilih Semua</label>
                    </div>
                    <h5 class="mb-0">Total: <span id="totalHarga" class="fw-bold text-primary">Rp0</span></h5>
                    <button type="submit" class="btn btn-primary px-4">Checkout</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.item-check');
            const qtyInputs = document.querySelectorAll('.item-qty');
            const totalHarga = document.getElementById('totalHarga');
            const selectAll = document.getElementById('selectAll');

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
        });
    </script>
@endsection