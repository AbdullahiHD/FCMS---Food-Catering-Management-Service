document.addEventListener('DOMContentLoaded', function () {
    var menuItems = document.querySelectorAll('.menu-item');
    var selectedMenu = document.getElementById('selected-menu');
    var createEventButton = document.querySelector('.create-event');
    var eventDateInput = document.getElementById("event-date");
    var takenDates = eventDatesArray || []; // Ensure the eventDatesArray is defined

    $(eventDateInput).datepicker({
        beforeShowDay: function(date) {
            var dateString = $.datepicker.formatDate('yy-mm-dd', date);
            // Check if the date is in the eventDatesArray
            if (takenDates.includes(dateString)) {
                // Highlight the date in red and make it unselectable
                return [true, 'highlighted-date', 'Date already taken'];
            }
            // Dates not in the eventDatesArray are selectable
            return [true, ''];
        },
        onSelect: function(selectedEventDate) {
            var formattedDate = $.datepicker.formatDate('yy-mm-dd', new Date(selectedEventDate));
            alert('Date selected: ' + formattedDate);
            // Here you can update eventDateInput if needed
            eventDateInput.value = formattedDate;
            if (takenDates.includes(eventDateInput.value)) {
                alert('Sorry, the selected date is already taken. Please choose another date.');
                eventDateInput.value = ''; // Clear the input field
            }
        }
    });    


    createEventButton.disabled = true; // Initially, disable the button


    menuItems.forEach(function (menuItem) {
        menuItem.addEventListener('click', function () {
            // Get the selected menu item's attributes
            var selectedMenuId = menuItem.id;
            var selectedMenuName = menuItem.querySelector('h3').textContent;
            var selectedMenuPrice = menuItem.getAttribute('data-price');
            
            // Show the selected menu and set its text
            selectedMenu.textContent = 'Selected Menu: ' + selectedMenuName;
            selectedMenu.style.display = 'inline-block'; // Show the selected menu

            // Store the selected Menu ID, Menu Name, and Price in session storage
            sessionStorage.setItem('selectedMenuId', selectedMenuId);
            sessionStorage.setItem('selectedMenuName', selectedMenuName);
            sessionStorage.setItem('selectedMenuPrice', selectedMenuPrice);

            // Enable the "Create Event Booking" button
            createEventButton.disabled = false;
        
            // Scroll down to the Create Event Booking button
            selectedMenu.scrollIntoView({
                behavior: 'smooth'
            });
        });
    });

    eventDateInput.addEventListener('change', function () {
        var selectedEventDate = eventDateInput.value;
        alert(selectedEventDate);
        if (takenDates.includes(selectedEventDate)) {
            alert('Sorry, the selected date is already taken. Please choose another date.');
            eventDateInput.value = ''; // Clear the input field
        }
    });

    createEventButton.addEventListener('click', function () {
        var selectedMenuId = sessionStorage.getItem('selectedMenuId');
        var selectedMenuName = sessionStorage.getItem('selectedMenuName');
        var selectedMenuPrice = sessionStorage.getItem('selectedMenuPrice');
        var name = encodeURIComponent(document.getElementById('name').value);
        var eventType = encodeURIComponent(document.getElementById('event-type').value);
        var eventTime = encodeURIComponent(document.getElementById('event-time').value);
        var eventDate = encodeURIComponent(document.getElementById('event-date').value);
        var deliveryAddress = encodeURIComponent(document.getElementById('delivery-address').value);
        var attendees = encodeURIComponent(document.getElementById('attendees').value);

        // Input validation for deliveryAddress (non-empty string)
        if (!name.trim()) {
            alert('Please enter a Name.');
            return;
        }

        // Input validation for deliveryAddress (non-empty string)
        if (!eventType.trim()) {
            alert('Please enter a valid Event Type.');
            return;
        }

        // Input validation for eventTime (non-empty string)
        if (!eventTime.trim()) {
            alert('Please enter a valid Event Time.');
            return;
        }

        // Input validation for eventDate (non-empty string)
        if (!eventDate.trim()) {
            alert('Please enter a valid Event Date.');
            return;
        }

        // Input validation for deliveryAddress (non-empty string)
        if (!deliveryAddress.trim()) {
            alert('Please enter valid Delivery Address.');
            return;
        }

        // Validate attendees to be a positive integer
        if (!attendees || isNaN(attendees) || parseInt(attendees) <= 0) {
            alert('Please enter a valid Number Of Attendees.');
            return;
        }

        if (!selectedMenuId || !selectedMenuName || !selectedMenuPrice) {
            alert('Please select a menu item first.');
        } else {  
            // Redirect to orderLuthfi.html with form input and menu item data as URL parameters
            var redirectUrl = '../FCMS-HTML/orderSummary.html' + 
                '?menuId=' + selectedMenuId +
                '&menuName=' + selectedMenuName +
                '&menuPrice=' + selectedMenuPrice +
                '&name=' + name +
                '&eventType=' + eventType +
                '&eventTime=' + eventTime +
                '&eventDate=' + eventDate +
                '&deliveryAddress=' + deliveryAddress +
                '&attendees=' + attendees;
            window.location.href = redirectUrl;
        }
    });
});
