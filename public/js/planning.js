// planning.js - tab switching + selection behavior (C: both card click and select button)

// Tab switching
document.addEventListener('DOMContentLoaded', function () {
    const pills = document.querySelectorAll('.planning-pill');
    const panes = document.querySelectorAll('.tab-pane');

    function activateTab(targetId) {
        pills.forEach(p => p.classList.remove('active'));
        panes.forEach(p => p.classList.remove('active'));

        const pill = document.querySelector('.planning-pill[data-target="' + targetId + '"]');
        const pane = document.getElementById(targetId);
        if (pill) pill.classList.add('active');
        if (pane) pane.classList.add('active');

        // scroll pane to top when switching
        if (pane) pane.scrollTop = 0;
    }

    pills.forEach(pill => {
        pill.addEventListener('click', function () {
            const target = this.dataset.target;
            activateTab(target);
        });
    });

    // default active
    if (pills.length) {
        const defaultTarget = pills[0].dataset.target;
        activateTab(defaultTarget);
    }

    // Selection behavior for cards and select buttons
    function bindSelectable(cardSelector, hiddenInputSelector) {
        document.querySelectorAll(cardSelector).forEach(card => {
            // click card
            card.addEventListener('click', function (e) {
                // prevent double if clicking button inside
                if (e.target.closest('.btn-select')) return;
                const id = this.dataset.id || '';
                const name = this.dataset.name || '';
                const price = this.dataset.price || '';
                // set hidden input
                const input = document.querySelector(hiddenInputSelector);
                if (input) input.value = id || price || name;
                // visual feedback
                document.querySelectorAll(cardSelector).forEach(c => c.classList.remove('selected'));
                this.classList.add('selected');
            });
        });

        // select button inside cards
        document.querySelectorAll(cardSelector + ' .btn-select').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                const card = this.closest(cardSelector);
                if (!card) return;
                const id = card.dataset.id || '';
                const name = card.dataset.name || '';
                const price = card.dataset.price || '';
                const input = document.querySelector(hiddenInputSelector);
                if (input) input.value = id || price || name;
                // visual feedback
                document.querySelectorAll(cardSelector).forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
            });
        });
    }

    // Bindings: use data attributes for id/name/price; hidden inputs in the form:
    bindSelectable('.destination-card', 'input[name="destination_price"]');
    bindSelectable('.hotel-card', 'input[name="hotel_price"]');
    bindSelectable('.car-card', 'input[name="car_price"]');

    // Basic validation on submit: ensure dates & at least 1 guest
    const planningForm = document.getElementById('planningForm');
    if (planningForm) {
        planningForm.addEventListener('submit', function (e) {
            const leaving = planningForm.querySelector('input[name="leaving_date"]').value;
            const returning = planningForm.querySelector('input[name="return_date"]').value;
            const adults = parseInt(planningForm.querySelector('input[name="adults"]').value || 0);
            const children = parseInt(planningForm.querySelector('input[name="children"]').value || 0);
            const special = parseInt(planningForm.querySelector('input[name="special_needs"]').value || 0);
            const guests = adults + children + special;
            let err = '';
            if (!leaving || !returning) err += 'Please set leaving and returning dates.\\n';
            if (guests < 1) err += 'At least 1 guest is required.\\n';
            if (err) {
                e.preventDefault();
                alert(err);
            }
        });
    }
});
