document.addEventListener('DOMContentLoaded', function () {
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
        var attendees = document.getElementById('attendees').textContent; // Get attendees from the summary
        
        if (!selectedProductId || !selectedPrice) {
            alert('Please select a menu item first.');
        } else {
            // Redirect to orderLuthfi.html with form input and menu item data as URL parameters
            var redirectUrl = 'orderLuthfi.html' + '?productId=' + selectedProductId + '&price=' + selectedPrice +
                              '&name=' + encodeURIComponent(name) +
                              '&eventTime=' + encodeURIComponent(eventTime) +
                              '&eventDate=' + encodeURIComponent(eventDate) +
                              '&deliveryAddress=' + encodeURIComponent(deliveryAddress) +
                              '&attendees=' + encodeURIComponent(attendees);
            window.location.href = redirectUrl;
        }
    });

    
    
    // Determine the product name based on productId (you can customize this logic)
    var productName;
    if (productId === 'Menu 1') {
        productName = 'Menu 1';
    } else if (productId === 'Menu 2') {
        productName = 'Menu 2';
    } else if (productId === 'Menu 3') {
        productName = 'Menu 3';
    } else {
        productName = 'Unknown Menu';
    }
    
    // Set product details in the order summary
    document.getElementById('productName').textContent = productName;
    document.getElementById('menuPrice').textContent = price;
    
    // Calculate total price
    var totalPrice = price * attendees;
    document.getElementById('totalPrice').textContent = totalPrice;
});
