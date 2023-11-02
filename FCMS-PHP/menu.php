<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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
        margin-top: 20px;
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
            flex-wrap:wrap;
            justify-content: space-around;
            align-items: flex-start;
            border: 2px solid #FFD100;
            padding: 10px;
            width: 100%; /* Set the width to 100% */
            max-width: 960px; /* Set a maximum width for larger screens */
            background-color: black;
        }
        .menu-item p{
            margin-top: 5px;
            color: #FFD100;
            font-family: 'Helvetica Neue', sans-serif;
        }
        .menu-item {
            text-align: center;
            flex: 0 0 80%; /* Set the flex basis to 30% */
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
            width: 250px;
            height: 250px;
            border: 1px solid #FFD100;
            transition: transform 0.3s ease;
        }

        .menu-item:hover {
            /* Change the border color to trigger hover effect */
            border: 1px solid #FFD100;
        }

        .menu-item:hover img {
            transform: scale(1.04);
        }

        .menu-item .additional-info {
            position: absolute;
            bottom: 101%;
            left: -10%;
            height: fit-content;
            width: fit-content;
            background-color: black;
            display: flex;
            flex-direction: row; /* Arrange content horizontally */
            justify-content: flex-start; /* Align content to the left */
            align-items: center;
            opacity: 0;
            transform: scale(0.8);
            transition: opacity 0.3s ease, transform 0.3s ease;
            padding: 15px;
            z-index: 1;
        }

         /* Use pointer-events to prevent hover on .additional-info */
         .menu-item .additional-info {
            pointer-events: none;
        }

        .menu-item:hover .additional-info {
            opacity: 0.99;
            transform: scale(1);
            pointer-events: auto; /* Re-enable pointer events on hover */
            z-index: 2; /* Set a higher z-index value on hover */
        }

        /* Style the additional info elements */
        .menu-item .additional-info img {
            width: 300px; /* Adjust the image size as needed */
            height: 300px; /* Adjust the image size as needed */
            margin-right: 20px; /* Add spacing between image and text */
        }

        .menu-item .additional-info .text-container {
            display: flex;
            flex-direction: column; /* Stack content top to bottom */
            align-items: center; /* Align content to the left */
        }

        .menu-item .additional-info .text-container h3 {
            color: #FFD100;
            font-size: 58px;
            margin: 0;
        }

        .menu-item .additional-info .text-container p {
            color: white;
            font-size: 24px;
            margin: 0;
            margin-top: 5px;
        }

        .menu-select-button {
            margin-top: 10px;
            display: inline-block;
            background-color: #FFD100;
            color: #202020;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .menu-select-button:hover {
            background-color: #FFEE32;
            color: #333533;
        }

        .form-container {
            align-items: center;
            margin-top: 80px;
            width: 40%;
            padding: 10px;
            border: 0px solid white;
            border-radius: 1px;
            background-color:black;
            margin-bottom: 10px;
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
        }

        input[type="text"],
        input[type="time"],
        input[type="date"],
        input[type="number"],
        select[id="event-type"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        
        .selected-output {
            margin-top: 10px;
            background-color: #FFD100;
            color: #202020;
            margin-bottom: 10px;
        }
        .selected-output p {
            display: none;
            padding: 0px 10px;
        }
        @media screen and (max-width: 768px) {
        /* Add responsive styles for smaller screens */
        .menu-box {
            flex-direction: column;
            align-items: center;
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
            <li><a href="menu.php">Menu</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">About</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">Our Team</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">Contact</a></li>
            
        </ul>
        /* <a href="" class="registrationbutton">Login</a> */
    
    
    
    </nav>

    <div class="form-container">
        <h2>Event Details Form</h2>
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
            <input type="date" id="event-date" name="event-date" required>

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
            
            echo '    <br>';
            echo '    <p id="menu_' . $row["MenuID"] . '">' . $row["MenuName"] . '</p>';
            echo '    <p id="price_' . $row["MenuID"] . '">' . $row["Price"] . ' RM</p>';
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

    // Close the database connection
    $conn->close();
?>

    <!-- ?> -->

    
    <!-- <div class="menu-box"> -->
        <!-- <div class="menu-item" id="Menu 1" data-price="60"> 
            <img src="../FCMS-Assets/images/hero-slider-1.jpg" alt="Menu 1">
            <br>
            <p id="menu_1">Menu 1</p>
            <p id="price_1">60 RM</p>
            <div class="additional-info">
                <img src="../FCMS-Assets/images/hero-slider-1.jpg" alt="Menu 1 Enlarged">
                <div class="text-container">
                    <h3>Menu 1</h3>
                    <p>Appetiser</p>
                    <p>Main Dish</p>
                    <p>Dessert</p>
                    <p>Drink</p>
                </div>
            </div> -->

            <!-- <button class="menu-select-button">Select</button>
        </div>
        <div class="menu-item" id="Menu 2" data-price="60">
            <img src="../FCMS-Assets/images/hero-slider-2.jpg" alt="Menu 2"> 
            <br>
            <p id="menu_2">Menu 2</p>
            <p id="price_2">60 RM</p>
            <div class="additional-info">
                <img src="../FCMS-Assets/images/hero-slider-2.jpg" alt="Menu 2 Enlarged">
                <div class="text-container">
                    <h3>Menu 2</h3>
                    <p>Appetiser</p>
                    <p>Main Dish</p>
                    <p>Dessert</p>
                    <p>Drink</p>
                </div>
            </div>
            <button class="menu-select-button">Select</button>

        </div>
        <div class="menu-item" id="Menu 3" data-price="80">
            <img src="../FCMS-Assets/images/hero-slider-3.jpg"alt="Menu 3">
            <br>
            <p id="menu_3">Menu 3</p>
            <p id="price_3">80 RM</p>
            <div class="additional-info">
                <img src="../FCMS-Assets/images/hero-slider-3.jpg"alt="Menu 3">
                <div class="text-container">
                    <h3>Menu 3</h3>
                    <p>Appetiser</p>
                    <p>Main Dish</p>
                    <p>Dessert</p>
                    <p>Drink</p>
                </div>
            </div>
            <button class="menu-select-button">Select</button>

        </div>
        <div class="menu-item" id="Menu 4" data-price="90">
            <img src="../FCMS-Assets/images/hero-slider-3.jpg" alt="Menu 3">
            <br>
            <p id="menu_4">Somali Cuisine</p>
            <p id="price_4">90 RM</p>
            <div class="additional-info">
                <img src="../FCMS-Assets/images/hero-slider-3.jpg" alt="Menu 4">
                <div class="text-container">
                    <h3>Somali Cuisine</h3>
                    <p>Appetiser</p>
                    <p>Main Dish</p>
                    <p>Dessert</p>
                    <p>Drink</p>
                </div>
            </div>
            <button class="menu-select-button">Select</button>
        
        </div> -->
    </div>

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