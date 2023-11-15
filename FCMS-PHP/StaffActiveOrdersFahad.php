<!DOCTYPE html>
<html lang="en">
<head>
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
            <li><a href="../FCMS-chatapp/users.php">Chat</a></li>
            <li><a href="StaffDashboardFahad.php">Dashboard</a></li>
            <li><a href="StaffPendingRequestsFahad.php">Pending Requests</a></li>
            <li><a href="StaffActiveOrdersFahad.php">Active Orders</a></li>
            <li><a href="StaffProfilePage.php">Profile</a></li>
            <li><a href="Guides.php">Guides</a></li>
        </ul>
    </nav>

    <!-- Content for Active Orders page -->
    <div class="orders-content">
        <h1>Active Orders</h1>

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

            $orderID = null;

            // SQL query to retrieve data from the "Orders" table
            $sql = "SELECT * FROM Orders WHERE OrderStatus = 'Active' LIMIT 5";
            $result = $conn->query($sql);

            // Check if there are any active orders
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $orderID = $row['OrderID'];
                    echo '<div class="order-div">';
                    echo '<div class="order-content-active">';
                    echo '<div class="order-title">Order #' . $orderID . '</div>';
                    echo '<a href="OrderDetailsPage.php?orderID=' . $orderID . '">View Order Details and Task Assignment</a>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No active orders found.";
            }

            // Close the database connection
            $conn->close();
        ?>
    </div>

</body>
</html>
