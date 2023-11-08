<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="../FCMS-CSS/StaffDashboardFahad.css">
    <link rel="stylesheet" href="../FCMS-CSS/EventExecutionWorkflow.css" />
    <title>Order Details</title>
</head>
<body>
    <!-- Navbar -->
    <nav>
        <a href="#" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
        <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="AdminPendingRequests.php">Pending Requests</a></li>
            <li><a href="AdminActiveOrder">Active Orders</a></li>
        </ul>
    </nav>


    <!-- Content for Order Details page -->
    <div class="order-details-content">
        <h1>Order Details</h1>

        <?php
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";  // Replace with your database password
            $dbname = "fcms";

            // Create a connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check the connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            if (isset($_GET['orderID'])) {
                $orderID = $_GET['orderID'];

                // SQL query to retrieve data for a specific order
                $sql = "SELECT * FROM Orders WHERE OrderID = $orderID";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo '<div class="orderdetails-div">';
                    echo '<div class="order-content">';
                    echo '<div class="order-title">Order #' . $orderID . '</div>';
                    echo '<p><strong>Customer Name:</strong> ' . $row['CustomerName'] . '</p>';
                    echo '<p><strong>Event Date:</strong> ' . $row['EventDate'] . '</p>';
                    echo '<p><strong>Event Time:</strong> ' . $row['EventTime'] . '</p>';
                    echo '<p><strong>Order Status:</strong> ' . $row['OrderStatus'] . '</p>';
                    echo '<p><strong>Delivery Address:</strong> ' . $row['DeliveryAddress'] . '</p>';
                    echo '<p><strong>Menu ID:</strong> ' . $row['MenuID'] . '</p>';
                    echo '</div>';
                    echo '<div class="task-assignment">';
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
                } else {
                    echo "Order not found.";
                }
            } else {
                echo "Order ID not provided.";
            }

            // Handle form submission
            if (isset($_POST['saveButton'])) {
                // Get the selected employees and update the "AssignedEmployees" field in the "Orders" table
                $assignedEmployees = '';
                foreach ($occupations as $occupation) {
                    if (isset($_POST[$occupation])) {
                        $selectedEmployee = $_POST[$occupation];
                        $assignedEmployees .= "$selectedEmployee ($occupation), ";
                    }
                }

                // Remove the trailing comma and space
                $assignedEmployees = rtrim($assignedEmployees, ', ');

                $updateQuery = "UPDATE Orders SET AssignedEmployees = '$assignedEmployees' WHERE OrderID = $orderID";

                if ($conn->query($updateQuery) === TRUE) {
                    echo "Assigned employees saved successfully for Order #$orderID.";
                } else {
                    echo "Error updating record: " . $conn->error;
                }
            }

            // Close the database connection
            $conn->close();
        ?>
    </div>
    <div class="board">
      <h2>Event Execution Workflow</h2>
      <form id="todo-form">
        <input type="text" placeholder="New TODO..." id="todo-input" />
        <button type="submit">Add +</button>
      </form>

      <div class="lanes">
        <div class="swim-lane" id="todo-lane">
          <h3 class="heading">TODO</h3>

          <p class="task" draggable="true">Clean-Up</p> 
          <p class="task" draggable="true">Leftover Food Management</p> 
          <p class="task" draggable="true">Staff Evaluation</p> 
        </div>

        <div class="swim-lane">
          <h3 class="heading">Doing</h3>

          <p class="task" draggable="true">Event Setup</p>
          <p class="task" draggable="true">Quality Control</p>
        </div>

        <div class="swim-lane">
          <h3 class="heading">Done</h3>
          <p class="task" draggable="true">Food Preparation</p>
          <p class="task" draggable="true">Transport Equipment</p>
          <p class="task" draggable="true">Decor and Presentation</p>

        </div>
      </div>
    </div>
    <script src="../FCMS-JavaScripts/EventExecutionWorkflow.js" defer></script>
</body>
</html>
