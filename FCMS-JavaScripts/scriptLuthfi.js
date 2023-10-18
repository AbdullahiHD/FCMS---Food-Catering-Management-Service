document.addEventListener('DOMContentLoaded', function () {
    // Check if the current page is orderSummary.html
    if (window.location.pathname.endsWith('orderSummary.html')) {
        // Get URL parameters and populate the order summary elements here
        const urlParams = new URLSearchParams(window.location.search);
        const name = urlParams.get('name');
        const eventTime = urlParams.get('eventTime');
        const eventDate = urlParams.get('eventDate');
        const deliveryAddress = urlParams.get('deliveryAddress');
        const attendees = urlParams.get('attendees');
        const productId = urlParams.get('productId');
        const price = urlParams.get('price');

        // Populate the order summary elements
        document.getElementById('name').textContent = name;
        document.getElementById('event-time').textContent = eventTime;
        document.getElementById('event-date').textContent = eventDate;
        document.getElementById('delivery-address').textContent = deliveryAddress;
        document.getElementById('attendees').textContent = attendees;
        document.getElementById('menu-item').textContent = productId; // You might want to retrieve the actual product name based on the ID
        document.getElementById('selected-menu').textContent = price;

        // Calculate total price and display it
        var totalPrice = parseFloat(price) * parseInt(attendees);
        document.getElementById('totalPrice').textContent = totalPrice + ' RM';
    }
    
    var menuItems = document.querySelectorAll('.menu-item');
    var selectedMenu = document.getElementById('selected-menu');
    var createEventButton = document.querySelector('.create-event');
    createEventButton.disabled = true; // Initially, disable the button

    menuItems.forEach(function (menuItem) {
        menuItem.addEventListener('click', function () {
            // Get the selected menu item's alt attribute (menu description)
            var selectedMenuText = menuItem.querySelector('img').alt;
            var productId = menuItem.id; // Get the product ID from the menu item's id
            var price = menuItem.getAttribute('data-price'); // Get the price from data-price attribute
            
            // Show the selected menu and set its text
            selectedMenu.textContent = 'Selected Menu: ' + selectedMenuText;
            selectedMenu.style.display = 'inline-block'; // Show the selected menu

            // Store the selected product ID and price in sessionStorage
            sessionStorage.setItem('selectedProductId', productId);
            sessionStorage.setItem('selectedPrice', price);

            // Enable the "Create Event Booking" button
            createEventButton.disabled = false;
        });
    });

    createEventButton.addEventListener('click', function () {
        var selectedProductId = sessionStorage.getItem('selectedProductId');
        var selectedPrice = sessionStorage.getItem('selectedPrice');
        
        var name = document.getElementById('name').value;
        var eventTime = document.getElementById('event-time').value;
        var eventDate = document.getElementById('event-date').value;
        var deliveryAddress = document.getElementById('delivery-address').value;
        var attendees = document.getElementById('attendees').value;

        // Validate attendees to be a positive integer
        if (!attendees || isNaN(attendees) || parseInt(attendees) <= 0) {
            alert('Please enter a valid number of attendees.');
            return;
        }
        // Input validation for eventTime (non-empty string)
        if (!eventTime.trim()) {
            alert('Please enter a valid event time.');
            return;
        }

        // Input validation for eventDate (non-empty string)
        if (!eventDate.trim()) {
            alert('Please enter a valid event date.');
            return;
        }

        // Input validation for name and deliveryAddress (non-empty string)
        if (!name.trim() || !deliveryAddress.trim()) {
            alert('Please enter valid name and delivery address.');
            return;
        }
        
        var selectedProductId = sessionStorage.getItem('selectedProductId');
        var selectedPrice = sessionStorage.getItem('selectedPrice');
        var name = encodeURIComponent(document.getElementById('name').value);
        var eventTime = encodeURIComponent(document.getElementById('event-time').value);
        var eventDate = encodeURIComponent(document.getElementById('event-date').value);
        var deliveryAddress = encodeURIComponent(document.getElementById('delivery-address').value);
        var attendees = encodeURIComponent(document.getElementById('attendees').value);

        if (!selectedProductId || !selectedPrice) {
            alert('Please select a menu item first.');
        } else {
            // Redirect to orderLuthfi.html with form input and menu item data as URL parameters
            var redirectUrl = 'orderLuthfi.html' + 
                  '?productId=' + selectedProductId + 
                  '&price=' + selectedPrice +
                  '&name=' + name +
                  '&eventTime=' + eventTime +
                  '&eventDate=' + eventDate +
                  '&deliveryAddress=' + deliveryAddress +
                  '&attendees=' + attendees;
            window.location.href = redirectUrl;
        }
    });
});
