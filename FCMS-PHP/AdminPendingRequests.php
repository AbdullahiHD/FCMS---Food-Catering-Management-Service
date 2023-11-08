<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="../FCMS-CSS/StaffDashboardFahad.css">
    <title>Pending Requests</title>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <a href="#" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
        <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="#">Pending Requests</a></li>
            <li><a href="AdminActiveOrders.php">Active Orders</a></li>
        </ul>
    </nav>

    <!-- Content for Pending Requests page -->
    <div class="requests-content">
        <h1>Pending Requests</h1>

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

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['acceptRequest'])) {
                $requestId = $_POST['requestId'];

                // First, insert the request data into the "orders" table
                $sql = "INSERT INTO Orders (CustomerName, EventTime, EventDate, DeliveryAddress, NumberOfAttendees, MenuID, OrderStatus)
                    SELECT CustomerName, EventTime, EventDate, DeliveryAddress, NumberOfAttendees, MenuID, 'Active'
                    FROM Requests
                    WHERE RequestID = $requestId";
                
                if ($conn->query($sql) === TRUE) {
                    // Order data successfully inserted
                    echo '<script>alert("Request has been transferred to Orders.");</script>';
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                //delete the request from the "Requests" table
                $sql = "DELETE FROM Requests WHERE RequestID = $requestId";

                if ($conn->query($sql) === TRUE) {
                    // Request successfully deleted
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rejectRequest'])) {
                $requestId = $_POST['requestId'];

                $sql = "DELETE FROM Requests WHERE RequestID = $requestId";

                if ($conn->query($sql) === TRUE) {
                    echo '<script>alert("Refund sent to customer.");</script>';
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }

            // SQL query to retrieve data from the "Requests" table
            $sql = "SELECT * FROM Requests";
            $result = $conn->query($sql);

            // Check if there are any requests
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="frequest-div" id="request-' . $row['RequestID'] . '">';
                    echo '<h3 class="request-title">Request #'.$row['RequestID'].'</h3>';
                    
                    echo '<div class="request-details" id="request-details-' . $row['RequestID'] . '">';
                    echo '<p><strong>Customer Name:</strong> ' . $row['CustomerName'] . '</p>';
                    echo '<p><strong>Event Date:</strong> ' . $row['EventDate'] . '</p>';
                    echo '<p><strong>Event Time:</strong> ' . $row['EventTime'] . '</p>';
                    echo '<p><strong>Number of Attendees:</strong> ' . $row['NumberOfAttendees'] . '</p>';
                    echo '<p><strong>Menu ID:</strong> ' . $row['MenuID'] . '</p>';
                    echo '</div>';

                    echo '<div class="action-buttons">';
                    echo '<form method="post" action="">';
                    echo '<input type="hidden" name="requestId" value="' . $row['RequestID'] . '">';
                    echo '<button class="accept-button" name="acceptRequest">Accept</button>';
                    echo '<button class="reject-button" name="rejectRequest">Reject</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No records found.";
            }

            // Close the database connection
            $conn->close();
        ?>
    </div>
</body>
</html>
