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
          <img src="../FCMS-Assets/images/culinarycue.png" width="160" height="30" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="StaffDashboardFahad.html">Dashboard</a></li>
            <li><a href="StaffPendingRequestsFahad.html">Pending Requests</a></li>
            <li><a href="StaffActiveOrdersFahad.html">Active Orders</a></li>
            
        </ul>
    
    </nav>
    <!-- Content for Active Orders page -->
    <div class="orders-content">
        <h1>Active Orders</h1>

        <div class="forder-div">
            <h3 class="order-title">Order #1</h3>
        </div>
        
        <div class="forder-div">
            <h3 class="order-title">Order #2</h3>
        </div>

    </div>
</body>
</html>


<?php
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

// SQL query to retrieve only "Active" orders with a limit of 5 
$sql = "SELECT * FROM Orders WHERE OrderStatus = 'Active' LIMIT 5";
$result = $conn->query($sql);

// Check if there are orders
if ($result->num_rows > 0) {
    // Array to hold orders
    $orders = array();

    // Fetch data and add it to the array
    while ($row = $result->fetch_assoc()) {
        $orders[] = $row;
    }

    // Convert the ordersto JSON format
    $json_orders = json_encode($orders);

    // Output the data or JSON to the browser
    echo $json_orders;

} else {
    echo "No active orders found.";
}

// Close the database connection
$conn->close();
?>
