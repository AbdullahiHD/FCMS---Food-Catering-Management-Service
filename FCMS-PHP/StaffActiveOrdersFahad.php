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
            <li><a href="StaffDashboardFahad.php">Dashboard</a></li>
            <li><a href="StaffPendingRequestsFahad.php">Pending Requests</a></li>
            <li><a href="StaffActiveOrdersFahad.php">Active Orders</a></li>
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

            // Handle form submission
            if (isset($_POST['saveButton'])) {
                $orderID = $_POST['orderID'];

                // Get the selected employee names and occupations and concatenate them
                $assignedEmployees = '';
                $occupations = ['EventPlanner', 'EventManager', 'ExecutiveChef', 'SousChef', 'LineCook', 'Dishwasher', 'Server', 'DeliveryDriver'];

                foreach ($occupations as $occupation) {
                    if (isset($_POST[$occupation])) {
                        $selectedEmployee = $_POST[$occupation];
                        $assignedEmployees .= "$selectedEmployee ($occupation), ";
                    }
                }

                // Remove the trailing comma and space
                $assignedEmployees = rtrim($assignedEmployees, ', ');

                // Update the "AssignedEmployees" field in the "Orders" table
                $updateQuery = "UPDATE Orders SET AssignedEmployees = '$assignedEmployees' WHERE OrderID = $orderID";

                if ($conn->query($updateQuery) === TRUE) {
                    echo "Assigned employees saved successfully for Order #$orderID.";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            // SQL query to retrieve data from the "Orders" table
            $sql = "SELECT * FROM Orders WHERE OrderStatus = 'Active' LIMIT 5";
            $result = $conn->query($sql);

            // Check if there are any active orders
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $orderID = $row['OrderID'];
                    echo '<div class="order-div">';
                    echo '<div class="order-content">';
                    echo '<div class="order-title">Order #' . $orderID . '</div>';
                    echo '<div class="order-details" style="display: none">';
                    echo '<p><strong>Customer Name:</strong> ' . $row['CustomerName'] . '</p>';
                    echo '<p><strong>Event Date:</strong> ' . $row['EventDate'] . '</p>';
                    echo '<p><strong>Event Time:</strong> ' . $row['EventTime'] . '</p>';
                    echo '<p><strong>Order Status:</strong> ' . $row['OrderStatus'] . '</p>';
                    echo '<p><strong>Delivery Address:</strong> ' . $row['DeliveryAddress'] . '</p>';
                    echo '<p><strong>Menu ID:</strong> ' . $row['MenuID'] . '</p>';
                    echo '</div>';
                    echo '<div class="task-assignment" style="display: none">';
                    echo '<h3>Task Assignment System</h3>';
                    echo '<form method="post" action="">';

                    // Create a dropdown for each occupation and populate from Employees table
                    $occupations = ['EventPlanner', 'EventManager', 'ExecutiveChef', 'SousChef', 'LineCook', 'Dishwasher', 'Server', 'DeliveryDriver'];
                    foreach ($occupations as $occupation) {
                        echo "<label for='$occupation'>$occupation:</label>";
                        echo "<select name='$occupation' id='$occupation'>";
                        // Query to retrieve employees by occupation
                        $employeeQuery = "SELECT EmployeeName FROM Employees WHERE Occupation = '$occupation'";
                        $employeeResult = $conn->query($employeeQuery);
                        while ($employee = $employeeResult->fetch_assoc()) {
                            echo "<option value='{$employee['EmployeeName']}'>{$employee['EmployeeName']}</option>";
                        }
                        echo "</select>";
                    }

                    echo '<input type="hidden" name="orderID" value="' . $orderID . '">';
                    echo '<button type="submit" name="saveButton">Save</button>';
                    echo '</form>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo "No active orders found.";
            }

            // Close the database connection
            $conn->close();
        ?>


        <script>
            var orderDivs = document.querySelectorAll('.order-div');

            orderDivs.forEach(function (orderDiv) {
                var orderDetails = orderDiv.querySelector('.order-details');
                var taskAssignment = orderDiv.querySelector('.task-assignment');
                var expanded = false;

                orderDiv.addEventListener('click', function () {
                    if (expanded) {
                        orderDetails.style.display = 'none';
                        taskAssignment.style.display = 'none';
                        orderDiv.style.minHeight = '100px';
                    } else {
                        orderDetails.style.display = 'block';
                        taskAssignment.style.display = 'block';
                        orderDiv.style.minHeight = '600px';
                    }
                    expanded = !expanded;
                });
            });

            // Prevent click on dropdowns from triggering the orderDiv click event to stop event propogation
            var dropdowns = document.querySelectorAll('select');
            dropdowns.forEach(function (dropdown) {
                dropdown.addEventListener('click', function (e) {
                    e.stopPropagation(); 
                });
            });
        </script>
    </div>
</body>
</html>
