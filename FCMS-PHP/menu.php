<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Include jQuery UI Datepicker styles -->
    <!-- Include jQuery UI Datepicker styles -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Include jQuery and jQuery UI libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <style>
        /* Additional CSS for this specific page */
        body {
            display:flex;
            align-items: center;
            flex-direction: column;
            min-height:100vh;
            margin: 0;
            padding: 0;
            background-image: url(../FCMS-Assets/images/hero-slider-1.jpg);
        }

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap");

        .footer {
        margin-top: auto;
        position: relative;
        width: 100%;
        background: #000000;
        min-height: 100px;
        padding: 20px 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        
        }

        .social-icon,
        .menu {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px 0;
        flex-wrap: wrap;
        }

        .social-icon__item,
        .menu__item {
        list-style: none;
        }

        .social-icon__link {
        font-size: 2rem;
        color: #fff;
        margin: 0 10px;
        display: inline-block;
        transition: 0.5s;
        }
        .social-icon__link:hover {
        transform: translateY(-10px);
        }

        .menu__link {
        font-size: 1.2rem;
        color: #fff;
        margin: 0 10px;
        display: inline-block;
        transition: 0.5s;
        text-decoration: none;
        opacity: 0.75;
        font-weight: 300;
        }

        .menu__link:hover {
        opacity: 1;
        }

        .footer p {
        color: #fff;
        margin: 15px 0 10px 0;
        font-size: 1rem;
        font-weight: 300;
        }

        .menu-box {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            align-items: flex-start;
            border: 2px solid #FFD100;
            padding: 5px;
            width: 50%; /* Set the width to 90% of the parent container */
            max-width: 50%; /* Set a maximum width for larger screens */
            margin: 0 auto; /* Center the menu-box */
            background-color: black;
            z-index: 1;
            border-radius: 15px;
        }
        .menu-item h3{
            margin-top: 8px;
        }
        .menu-item {
            text-align: center;
            flex: 1 1 250%; /* Set the flex basis to 30% */
            max-width: calc(33.333% - 20px); /* Set the maximum width for 3 items with margin */
            margin: 10px;
            position: relative;
            padding: 10px;
            box-sizing: border-box; /* Include padding and border in the element's total width and height */
        }

        .menu-item .image-container {
            position: relative;
            overflow: hidden;
        }


        .menu-item img {
            width: 200px;
            height: 200px;
            border: 1px solid #FFD100;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .menu-item .additional-info {
            position: fixed;
            top: 0;
            left: 0px;
            width: 24vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.8); /* Adjust the background color and opacity */
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            z-index: 2;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.3s ease, visibility 0.3s ease;
        }

         /* Use pointer-events to prevent hover on .additional-info */
         .menu-item .additional-info {
            pointer-events: none;
        }
        
        .menu-item img:hover{
            transform: scale(1.05);
        }
        .menu-item img:hover ~ .additional-info,
        .menu-item .additional-info:hover {
            opacity: 1;
            transform: scale(1);
            pointer-events: auto; /* Re-enable pointer events on hover */
            visibility: visible;
        }

        /* Style the additional info elements */
        .menu-item .additional-info img {
            width: 350px; /* Adjust the image size as needed */
            height: 350px; /* Adjust the image size as needed */
        }

        .menu-item .additional-info .text-container {
            margin-top:20px;
            display: flex;
            flex-direction: column; /* Stack content top to bottom */
            align-items: center; /* Align content to the left */
        }

        .menu-item .additional-info .text-container h3 {
            color: #FFD100;
            font-size: 30px;
            margin: 0;
        }

        .menu-item .additional-info .text-container p {
            color: white;
            font-size: 24px;
            margin: 0;
            margin-top: 5px;
        }

        .menu-select-button {
            display: inline-block;
            background-color: #FFD100;
            color: #202020;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .menu-select-button:hover {
            background-color: #FFEE32;
            color: #333533;
        }

        .form-container {
            align-items: center;
            margin-top: 120px;
            width: 40%;
            padding: 15px;
            border: 2px solid #FFD100;
            background-color:black;
            margin-bottom: 30px;
            border-radius: 15px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            color: #FFD100;
            font-family: 'Helvetica Neue', sans-serif;
            font-size: 18px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="time"],
        input[id="event-date"],
        input[type="number"],
        select[id="event-type"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            font-family: Arial, Helvetica, sans-serif;
        }
        
        .selected-output {
            margin-top: 20px;
            background-color: #FFD100;
            color: #202020;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .selected-output p {
            color:#202020;
            display: none;
            font-size: 18px;
            padding: 10px 20px;
            font-size: 18px;
            background-color: #FFD100;
            border: none;
            align-items: center;
            height: 30px;
            border-radius: 5px;
        }
        @media screen and (max-width: 768px) {
            /* Add responsive styles for smaller screens */
            .menu-box {
                flex-direction: column;
                align-items: center;
            }
        }

        /* Add this style for highlighted dates */
        .highlighted-date {
            background-color: red;
            color: white; /* Set the text color to white for better visibility */
        }

        /* Style the jQuery UI Datepicker */
        .ui-datepicker {
            outline: 2px solid #FFD100;
            background-color: #202020;
            padding: 5px;
            font-size: 18px; 
            font-weight: bold;
            width: 300px;
        }

        /* Style the individual date cells */
        .ui-datepicker-calendar td {
        }

        /* Style the header of the datepicker */
        .ui-datepicker-header {
            background-color: #202020; /* Set the background color to your desired color */
            border: 1px solid #FFD100; /* Add a border with the desired color */
            font-size: 18px;
        }

        /* Style the selected date */
        .ui-datepicker-calendar .ui-state-active {
            background-color: #FFD100; /* Set the background color to the desired color */
            color: #202020; /* Set the text color to red */
            font-size: 16px;
        }

        /* Style the hover effect on date cells */
        .ui-datepicker-calendar td:hover {
            background-color: #FFD100; /* Set the background color on hover to the desired color */
        }


        .create-event-button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #FFD100;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
        }
            
    </style>
</head>

<body class="">

    <nav>
    
        <a href="#" class="logolink">
          <img src="../FCMS-Assets/images/culinarycue.png" width="100" height="60" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="../FCMS-HTML/TahaIndex.html">Home</a></li>
            <li><a href="../FCMS-PHP/menu.php">Menu</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">About</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">Our Team</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">Contact</a></li>
            
        </ul>
        <a href="" class="registrationbutton">Login</a>
    
    
    
    </nav>

    <div class="form-container">
        <h1>Event Booking Form</h1>
        <form>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="event-type">Event Type:</label>
            <select id="event-type" name="event-type" required>
                <option value="" disabled selected>Select Event Type</option>
                <option value="Wedding">Wedding</option>
                <option value="Birthday">Birthday</option>
                <option value="Corporate">Corporate</option>
                <option value="Other">Other</option>
            </select>

            <label for="event-time">Event Time:</label>
            <input type="time" id="event-time" name="event-time" required>

            
            <label for="event-date">Event Date:</label>
            <input id="event-date" name="event-date" required>
           
            
            <label for="delivery-address">Delivery Address:</label>
            <input type="text" id="delivery-address" name="delivery-address" required>

            <label for="attendees">Number Of Attendees:</label>
            <input type="number" id="attendees" name="attendees" required>
        </form>
    </div>

    <!-- Added php code on 18th/10/2023 Abdullahi -->
    <?php

    // session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $databaseName = "FCMS";

    // Creating a new mysqli connection
    $conn = new mysqli($servername, $username, $password, $databaseName);

    // Check if the connection was successful
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }

    // Query to fetch data for all menus, including the image file path
    $sql = "SELECT * FROM menus";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="menu-box">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="menu-item" id="Menu ' . $row["MenuID"] . '" data-price="' . $row["Price"] . '">';
            
            // Retrieve the image file path from the database
            $imagePath = $row["file_path"];

            // Display the image with the retrieved file path on hover effect
            echo '    <img src="' . $imagePath . '" alt="' . $row["MenuName"] . '">';
            echo '    <h3 id="menu_' . $row["MenuID"] . '">' . $row["MenuName"] . '</h3>';
            echo '    <h3 id="price_' . $row["MenuID"] . '">RM ' . $row["Price"] . ' </h3>';
            echo '    <div class="additional-info">';
            echo '        <img src="' . $imagePath . '" alt="' . $row["MenuName"] . ' Enlarged">';
            echo '        <div class="text-container">';
            echo '            <h3>' . $row["MenuName"] . '</h3>';
            echo '            <p>' . $row["Appetizer"] . '</p>';
            echo '            <p>' . $row["MainDish"] . '</p>';
            echo '            <p>' . $row["Dessert"] . '</p>';
            echo '            <p>' . $row["Drink"] . '</p>';
            echo '        </div>';
            echo '    </div>';
            echo '    <button class="menu-select-button">Select</button>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "No menu items found.";
    }
    // Query to fetch event dates from ORDERS table
    $sql = "SELECT eventDate FROM ORDERS";
    $result = $conn->query($sql);

    $eventDates = array();

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $eventDates[] = $row["eventDate"];
        }
    }


    // Close the database connection
    $conn->close();

    // Echo the $eventDates array as a JSON object into a JavaScript variable
    echo '<script>';
    echo 'const eventDatesArray = ' . json_encode($eventDates) . ';';
    echo '</script>';
?>

    <div class="selected-output">
        <p id="selected-menu"></p>
    </div>
   
    <button type="submit" value="Submit" name="submit" class="create-event-button create-event">Create Event Booking</button>

    <footer class="footer">
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-facebook"></ion-icon>
            </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-twitter"></ion-icon>
            </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-linkedin"></ion-icon>
            </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-instagram"></ion-icon>
            </a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#homenav">Home</a></li>
            <li class="menu__item"><a class="menu__link" href="#NavMenu">Menu</a></li>
            <li class="menu__item"><a class="menu__link" href="#Navabout">About</a></li>
            <li class="menu__item"><a class="menu__link" href="#Navteam">Our Team</a></li>
            <li class="menu__item"><a class="menu__link" href="#Navcontact">Contact</a></li>
        </ul>
        
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="../FCMS-JavaScripts/menuScript.js"></script>
</body>
</html>