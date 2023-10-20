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
    var confirmOrderButton = document.querySelector('.confirm-order');



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

    confirmOrderButton.addEventListener('click', function () {
        var redirectUrl = 'Quotation and Billing Page.html' +
            '?menuId=' + menuId +
            '&menuName=' + menuName +
            '&menuPrice=' + menuPrice +
            '&name=' + name +
            '&eventType=' + eventType +
            '&eventTime=' + eventTime +
            '&eventDate=' + eventDate +
            '&deliveryAddress=' + deliveryAddress +
            '&attendees=' + attendees;
        window.location.href = redirectUrl;
    });
});