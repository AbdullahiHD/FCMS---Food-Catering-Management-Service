<!DOCTYPE html>
<html lang="en">
<head>
    <style>
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="../FCMS-CSS/StaffDashboardFahad.css">
    <title>Active Orders</title>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <a href="#" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="AdminPendingOrders.php">Pending Requests</a></li>
            <li><a href="#">Active Orders</a></li>
        </ul>
    </nav>

    <div class="edit-details-content">
        <h1>Order Details</h1>
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

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    // Populate form with existing order details
                    $customerName = $row['CustomerName'];
                    $eventDate = $row['EventDate'];
                    $eventTime = $row['EventTime'];
                    $orderStatus= $row['OrderStatus'];
                    $deliveryAddress=$row['DeliveryAddress'];
                    // ... other fields ...

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
    </div>
</body>
</html>
