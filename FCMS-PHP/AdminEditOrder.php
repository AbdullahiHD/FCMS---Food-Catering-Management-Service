<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fcms";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if order ID is provided
if (isset($_GET['orderID'])) {
    $orderID = $_GET['orderID'];

    // SQL query to retrieve data for a specific order
    $sql = "SELECT * FROM Orders WHERE OrderID = $orderID";
    $result = $conn->query($sql);



    // Handle form submission for updating order details
    if (isset($_POST['updateButton'])) {
        // Retrieve form data
        $customerName = $_POST['customerName'];
        $eventDate = $_POST['eventDate'];
        $eventTime = $_POST['eventTime'];
        $orderStatus = $_POST['orderStatus'];
        $deliveryAddress = $_POST['deliveryAddress'];

        // Update the order in the database
        $updateQuery = "UPDATE Orders 
                    SET CustomerName = '$customerName', 
                        EventDate = '$eventDate', 
                        EventTime = '$eventTime', 
                        OrderStatus = '$orderStatus', 
                        DeliveryAddress = '$deliveryAddress' 
                    WHERE OrderID = $orderID";

        // Perform the update
        if ($conn->query($updateQuery) === TRUE) {
            echo "Order details updated successfully.";
        } else {
            echo "Error updating order details: " . $conn->error;
        }

        // Redirect back to AdminOrderDetails.php or any other page
        header("Location: AdminOrderDetailsPage.php?orderID=$orderID");
        exit();
    }

    // Close the database connection
    $conn->close();
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../FCMS-Assets/Main.css">
        <link rel="stylesheet" href="../FCMS-CSS/StaffDashboardFahad.css">
        <title>Edit Order</title>
        <!-- Link to navbar css -->
        <link rel="stylesheet" href="../FCMS-CSS/AdminNav.css">
        <style>
            nav ul {
                margin-left: 150px;
                background-color: rgb(11, 11, 10);
            }

            nav ul li {
                list-style-type: none;
                display: inline-block;
                padding: 10px 70px;
                background-color: rgb(11, 11, 10);
            }

            nav ul li a {
                color: goldenrod;
                text-decoration: none;
                font-family: 'Franklin Gothic Medium', sans-serif;
                font-weight: bold;
                text-transform: capitalize;
                font-size: 17px;

            }

            nav ul li a {
                position: relative;
                /* ... (rest of your styles) */
            }

            /* Before and After pseudo-elements represent the two lines */
            nav ul li a::before,
            nav ul li a::after {
                content: "";
                position: absolute;
                bottom: 0;
                left: 0;
                width: 0;
                height: 2px;
                /* Height of the line */
                background-color: goldenrod;
                /* Line color */
                transition: all 0.3s ease;
            }

            /* First line appears from the left */
            nav ul li a::before {
                bottom: 1px;
                /* Slight offset from the bottom to create gap between two lines */
            }

            /* Second line appears from the right */
            nav ul li a::after {
                bottom: -3px;
                /* Slight offset from the bottom */
                right: 0;
                left: auto;
                transform: scaleX(-1);
                /* Invert it to make it appear from right */
            }

            /* On hover, the lines animate to full width */
            nav ul li a:hover::before,
            nav ul li a:hover::after {
                width: 100%;
            }

            .dropdown .dropbtn {
                font-size: 20px;
                color: goldenrod;
                text-decoration: none;
                font-family: 'Franklin Gothic Medium', sans-serif;
                font-weight: bold;
                text-transform: capitalize;
                font-size: 17px;
                background-color: rgb(11, 11, 10);
                position: relative;
                margin-right: 400px;
            }

            .dropdown .dropbtn::before,
            .dropdown .dropbtn::after {
                content: "";
                position: absolute;
                bottom: 0;
                left: 0;
                width: 0;
                height: 2px;
                /* Height of the line */
                background-color: goldenrod;
                /* Line color */
                transition: all 0.3s ease;
            }


            .dropdown .dropbtn::before {
                bottom: 1px;
                /* Slight offset from the bottom to create gap between two lines */
            }

            /* Second line appears from the right */
            .dropdown .dropbtn::after {
                bottom: -3px;
                /* Slight offset from the bottom */
                right: 0;
                left: auto;
                transform: scaleX(-1);
                /* Invert it to make it appear from right */
            }

            /* On hover, the lines animate to full width */
            .dropdown .dropbtn:hover::before,
            .dropdown .dropbtn:hover::after {
                width: 100%;
            }


            .edit-details-content {
                margin-top: 35px;
            }

            form {
                max-width: 400px;
                margin: 0 auto;
                background-color: #553f05;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            form input {
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            form button {
                background-color: goldenrod;
                color: white;
                padding: 10px 15px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
        </style>

    </head>

    <body>
        <nav>
            <a href="../FCMS-HTML/TahaIndex.html" class="logolink">
                <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
            </a>
            <ul>
                <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
                <li><a href="../FCMS-PHP/EventManagement.php">Events</a></li>
                <li><a href="../FCMS-PHP/manageMenu.php">Menu</a></li>
                <li><a href="../FCMS-PHP/AdminCreateStaff.php">Staff</a></li>

            </ul>
            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn">Statistics</button>
                <div id="myDropdown" class="dropdown-content">
                    <li><a href="../FCMS-PHP/StaffStatistic.php">Staff</a></li>
                    <li><a href="../FCMS-PHP/OrderStatistic.php">Orders</a></li>
                    <li><a href="../FCMS-PHP/CustomerStatistics.php">Customers</a></li>
                    <li><a href="../FCMS-PHP/RevenueStatistic.php">Profits</a></li>
                </div>
            </div>


        </nav>


        <!-- Navbar -->
        <!-- <nav>
        <a href="#" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="AdminPendingOrders.php">Pending Requests</a></li>
            <li><a href="#">Active Orders</a></li>
        </ul>
    </nav> -->



        <div class="edit-details-content">
            <h1>Order Details</h1>
        <?php

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // Populate form with existing order details
            $customerName = $row['CustomerName'];
            $eventDate = $row['EventDate'];
            $eventTime = $row['EventTime'];
            $orderStatus = $row['OrderStatus'];
            $deliveryAddress = $row['DeliveryAddress'];


            // Output the form with populated values
            echo '<form method="post" action="">';
            echo '<label for="customerName">Customer Name:</label>';
            echo '<input type="text" name="customerName" value="' . $customerName . '" placeholder="Customer Name" required>';

            echo '<label for="eventDate">Event Date:</label>';
            echo '<input type="text" name="eventDate" value="' . $eventDate . '" placeholder="Event Date" required>';

            echo '<label for="eventTime">Event Time:</label>';
            echo '<input type="text" name="eventTime" value="' . $eventTime . '" placeholder="Event Time" required>';

            echo '<label for="orderStatus">Order Status:</label>';
            echo '<input type="text" name="orderStatus" value="' . $orderStatus . '" placeholder="Order Status" required>';

            echo '<label for="deliveryAddress">Delivery Address:</label>';
            echo '<input type="text" name="deliveryAddress" value="' . $deliveryAddress . '" placeholder="Delivery Address" required>';

            // ... other form fields ...

            echo '<button type="submit" name="updateButton">Update</button>';
            echo '</form>';
        } else {
            echo "Order not found.";
        }
    } else {
        echo "Order ID not provided.";
    }
        ?>
        </div>

        <script>
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }

            // Close the dropdown menu if the user clicks outside of it
            window.onclick = function(event) {
                if (!event.target.matches('.dropbtn')) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }
        </script>

    </body>

    </html>