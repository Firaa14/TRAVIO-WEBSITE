// planning.js - Enhanced planning functionality with date validation and multiple selection

document.addEventListener('DOMContentLoaded', function () {
    const pills = document.querySelectorAll('.planning-pill');
    const panes = document.querySelectorAll('.tab-pane');
    
    let datesConfirmed = false;
    let selectedDestinations = [];
    let selectedCars = [];
    let selectedHotelRoom = null;

    // Tab switching function
    function activateTab(targetId) {
        // Check if dates are confirmed before switching
        if (targetId !== 'tab-dates' && !datesConfirmed) {
            alert('Please confirm your travel dates first.');
            return false;
        }

        pills.forEach(p => p.classList.remove('active'));
        panes.forEach(p => p.classList.remove('active'));

        const pill = document.querySelector('.planning-pill[data-target="' + targetId + '"]');
        const pane = document.getElementById(targetId);
        if (pill) pill.classList.add('active');
        if (pane) pane.classList.add('active');

        // Scroll pane to top when switching
        if (pane) pane.scrollTop = 0;
        return true;
    }

    // Bind tab switching events
    pills.forEach(pill => {
        pill.addEventListener('click', function () {
            const target = this.dataset.target;
            activateTab(target);
        });
    });

    // Date validation and confirmation
    const leavingDateInput = document.getElementById('leaving_date');
    const returnDateInput = document.getElementById('return_date');
    const confirmDatesBtn = document.getElementById('confirm-dates');

    if (leavingDateInput && returnDateInput) {
        // Leaving date change
        leavingDateInput.addEventListener('change', function() {
            const leavingDate = new Date(this.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (leavingDate < today) {
                alert('Leaving date cannot be in the past.');
                this.value = '';
                return;
            }
            
            // Set minimum return date
            returnDateInput.min = this.value;
            
            // Auto-adjust return date if it's before leaving date
            if (returnDateInput.value && returnDateInput.value < this.value) {
                returnDateInput.value = this.value;
            }
        });

        // Return date change
        returnDateInput.addEventListener('change', function() {
            const returnDate = new Date(this.value);
            const leavingDate = new Date(leavingDateInput.value);
            
            if (returnDate < leavingDate) {
                alert('Return date cannot be earlier than leaving date.');
                this.value = leavingDateInput.value;
            }
        });
    }

    // Confirm dates functionality
    if (confirmDatesBtn) {
        confirmDatesBtn.addEventListener('click', function() {
            if (!leavingDateInput.value || !returnDateInput.value) {
                alert('Please select both leaving and return dates.');
                return;
            }
            
            datesConfirmed = true;
            this.style.display = 'none';
            
            // Add confirmation message
            const confirmMsg = document.createElement('div');
            confirmMsg.className = 'alert alert-success mt-2';
            confirmMsg.innerHTML = '<i class="bi bi-check-circle"></i> Dates confirmed! You can now select destinations and other options.';
            this.parentElement.appendChild(confirmMsg);
            
            // Hide date requirement alerts
            document.querySelectorAll('.alert[id$="-required-alert"]').forEach(alert => {
                alert.style.display = 'none';
            });
        });
    }

    // Multiple destination selection
    function handleDestinationSelection(button) {
        const card = button.closest('.destination-card');
        const id = card.dataset.id;
        const notification = card.querySelector('.selected-notification');
        
        if (selectedDestinations.includes(id)) {
            // Remove from selection
            selectedDestinations = selectedDestinations.filter(item => item !== id);
            button.textContent = 'Select';
            button.classList.remove('btn-success');
            button.classList.add('btn-action');
            notification.style.display = 'none';
        } else {
            // Add to selection
            selectedDestinations.push(id);
            button.textContent = 'Selected';
            button.classList.remove('btn-action');
            button.classList.add('btn-success');
            notification.style.display = 'block';
            
            // Show brief notification
            showNotification('Destination selected!');
        }
        
        // Update hidden input
        document.querySelector('input[name="selected_destinations"]').value = selectedDestinations.join(',');
    }

    // Multiple car selection
    function handleCarSelection(button) {
        const card = button.closest('.car-card');
        const id = card.dataset.id;
        const notification = card.querySelector('.selected-notification');
        
        if (selectedCars.includes(id)) {
            // Remove from selection
            selectedCars = selectedCars.filter(item => item !== id);
            button.textContent = 'Select';
            button.classList.remove('btn-success');
            button.classList.add('btn-action');
            notification.style.display = 'none';
        } else {
            // Add to selection
            selectedCars.push(id);
            button.textContent = 'Selected';
            button.classList.remove('btn-action');
            button.classList.add('btn-success');
            notification.style.display = 'block';
            
            // Show brief notification
            showNotification('Car selected!');
        }
        
        // Update hidden input
        document.querySelector('input[name="selected_cars"]').value = selectedCars.join(',');
    }

    // Hotel room selection
    function handleHotelSelection(button) {
        const card = button.closest('.hotel-card');
        const hotelId = card.dataset.id;
        const hotelName = card.dataset.name;
        const price = card.dataset.price;
        const notification = card.querySelector('.selected-notification');
        
        // For now, simulate room selection with default room
        // In production, this would open a modal or fetch actual rooms
        const roomData = {
            hotel_id: hotelId,
            hotel_name: hotelName,
            room_id: 1,
            room_name: 'Standard Room',
            price: price
        };
        
        selectedHotelRoom = roomData;
        button.textContent = 'Selected';
        button.classList.remove('btn-action');
        button.classList.add('btn-success');
        notification.style.display = 'block';
        
        // Update hidden input
        document.querySelector('input[name="selected_hotel_room"]').value = JSON.stringify(roomData);
        
        // Show brief notification
        showNotification('Hotel room selected!');
    }

    // Bind selection events
    document.querySelectorAll('.btn-select[data-type="destination"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!datesConfirmed) {
                alert('Please confirm your dates first.');
                return;
            }
            handleDestinationSelection(this);
        });
    });

    document.querySelectorAll('.btn-select[data-type="car"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!datesConfirmed) {
                alert('Please confirm your dates first.');
                return;
            }
            handleCarSelection(this);
        });
    });

    document.querySelectorAll('.btn-select-room').forEach(button => {
        button.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!datesConfirmed) {
                alert('Please confirm your dates first.');
                return;
            }
            handleHotelSelection(this);
        });
    });

    // Show notification function
    function showNotification(message) {
        // Create notification element if it doesn't exist
        let notification = document.getElementById('global-notification');
        if (!notification) {
            notification = document.createElement('div');
            notification.id = 'global-notification';
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: #28a745;
                color: white;
                padding: 15px 20px;
                border-radius: 5px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                z-index: 1050;
                opacity: 0;
                transition: opacity 0.3s;
            `;
            document.body.appendChild(notification);
        }
        
        notification.textContent = message;
        notification.style.opacity = '1';
        
        // Hide after 2 seconds
        setTimeout(() => {
            notification.style.opacity = '0';
        }, 2000);
    }

    // Form validation and submission
    const planningForm = document.getElementById('planningForm');
    if (planningForm) {
        planningForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!datesConfirmed) {
                alert('Please confirm your travel dates first.');
                // Switch to dates tab
                activateTab('tab-dates');
                return;
            }
            
            // Check if at least one item is selected
            if (selectedDestinations.length === 0 && !selectedHotelRoom && selectedCars.length === 0) {
                alert('Please select at least one destination, hotel, or car to continue.');
                return;
            }
            
            // Check guest count
            const adults = parseInt(document.querySelector('input[name="adults"]').value) || 1;
            const children = parseInt(document.querySelector('input[name="children"]').value) || 0;
            const special = parseInt(document.querySelector('input[name="special_needs"]').value) || 0;
            const totalGuests = adults + children + special;
            
            if (totalGuests < 1) {
                alert('At least 1 adult is required.');
                activateTab('tab-guests');
                return;
            }
            
            // All validations passed, submit the form
            this.submit();
        });
    }

    // Initialize with dates tab active
    activateTab('tab-dates');
});
