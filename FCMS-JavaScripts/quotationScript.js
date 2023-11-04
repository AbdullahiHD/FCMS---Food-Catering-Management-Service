
// Adding an event listener 
document.addEventListener('DOMContentLoaded', function () {
    // Get URL parameters and populate the order summary elements here
    const urlParams = new URLSearchParams(window.location.search);
    const name = urlParams.get('name');
    const eventType = urlParams.get('eventType');
    const eventTime = urlParams.get('eventTime');
    const eventDate = urlParams.get('eventDate');
    const deliveryAddress = urlParams.get('deliveryAddress');
    const attendees = urlParams.get('attendees');
    const menuId = urlParams.get('menuId');
    const menuName = urlParams.get('menuName');
    const menuPrice = urlParams.get('menuPrice');


    // Populate the order summary elements
    document.getElementById('name').textContent = name;
    document.getElementById('event-type').textContent = eventType;
    document.getElementById('event-time').textContent = eventTime;
    document.getElementById('event-date').textContent = eventDate;
    document.getElementById('delivery-address').textContent = deliveryAddress;
    document.getElementById('attendees').textContent = attendees;
    document.getElementById('menu-id').textContent = menuId;
    document.getElementById('menu-name').textContent = menuName;
    document.getElementById('menu-price').textContent = menuPrice;

    // Calculate total price and display it
    var totalPrice = parseFloat(menuPrice) * parseInt(attendees);
    document.getElementById('total-price').textContent = totalPrice;

    // Calculate tax and display it with 2 decimal points
    var tax = parseFloat(totalPrice) * 0.07;
    var formattedTax = tax.toFixed(2); // Round to 2 decimal points
    document.getElementById('tax-price').textContent = formattedTax;

    // Calculate total price + tax and display it with 2 decimal points
    var taxTotal = parseFloat(totalPrice) + parseFloat(formattedTax);
    var formattedTaxTotal = taxTotal.toFixed(2); // Round to 2 decimal points
    document.getElementById('tax-total').textContent = formattedTaxTotal;;
});

// Function to set form input values and submit the form
function submitForm() {
    // Get data from the page
    const name = document.getElementById('name').textContent;
    const eventType = document.getElementById('event-type').textContent;
    const eventTime = document.getElementById('event-time').textContent;
    const eventDate = document.getElementById('event-date').textContent;
    const deliveryAddress = document.getElementById('delivery-address').textContent;
    const attendees = document.getElementById('attendees').textContent;
    const menuId = document.getElementById('menu-id').textContent;
    const menuName = document.getElementById('menu-name').textContent;
    const menuPrice = document.getElementById('menu-price').textContent;
    const totalPrice = document.getElementById('total-price').textContent;

    // Set the form input values
    document.getElementById('name-input').value = name;
    document.getElementById('event-type-input').value = eventType;
    document.getElementById('event-time-input').value = eventTime;
    document.getElementById('event-date-input').value = eventDate;
    document.getElementById('delivery-address-input').value = deliveryAddress;
    document.getElementById('attendees-input').value = attendees;
    document.getElementById('menu-id-input').value = menuId;
    document.getElementById('menu-name-input').value = menuName;
    document.getElementById('menu-price-input').value = menuPrice;
    document.getElementById('total-price-input').value = totalPrice;

    // Submit the form
    document.getElementById('payment-form').submit();
    
}