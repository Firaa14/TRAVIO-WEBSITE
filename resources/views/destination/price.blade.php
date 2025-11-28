<div class="card shadow-sm p-4 mb-4 rounded-3">
    <h3 class="fw-bold mb-3">Price Details</h3>
    <ul class="mb-0">
        @foreach($destination['price'] as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>
<a href="#" class="btn btn-primary continue-btn rounded-3 mt-3 w-100">Continue</a>

<!-- Modal Pilihan Checkout/Keranjang -->
<div class="modal fade" id="continueModal" tabindex="-1" aria-labelledby="continueModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="continueModalLabel">Pilih Tindakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <button id="addToCartBtn" class="btn btn-outline-primary mb-2 w-100">Masuk ke Keranjang</button>
                <button id="checkoutBtn" class="btn btn-primary w-100">Checkout</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const continueBtn = document.querySelector('.continue-btn');
        const addToCartBtn = document.getElementById('addToCartBtn');
        const checkoutBtn = document.getElementById('checkoutBtn');

        // Show modal on continue click
        continueBtn.addEventListener('click', function (e) {
            e.preventDefault();
            var modal = new bootstrap.Modal(document.getElementById('continueModal'));
            modal.show();
        });

        // Add to cart action
        addToCartBtn.addEventListener('click', function () {
            // TODO: Ganti dengan AJAX/fetch ke route cart
            alert('item dimasukkan ke keranjang');
            bootstrap.Modal.getInstance(document.getElementById('continueModal')).hide();
        });

        // Checkout action
        checkoutBtn.addEventListener('click', function () {
            window.location.href = '/checkout-destinasi'; // Ganti dengan route checkout destinasi
        });
    });
</script>