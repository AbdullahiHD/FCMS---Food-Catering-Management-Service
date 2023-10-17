document.addEventListener('DOMContentLoaded', function () {
    var menuItems = document.querySelectorAll('.menu-item');
    var selectedMenu = document.getElementById('selected-menu');
    var createEventButton = document.querySelector('.create-event-button');
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
        
        if (!selectedProductId || !selectedPrice) {
            alert('Please select a menu item first.');
        } else {
            // Redirect to another webpage and include product ID and price as URL parameters
            var redirectUrl = 'orderLuthfi.html' + '?productId=' + selectedProductId + '&price=' + selectedPrice;
            window.location.href = redirectUrl;
        }
    });
});