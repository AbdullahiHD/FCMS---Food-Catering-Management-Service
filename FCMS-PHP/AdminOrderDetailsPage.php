<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="../FCMS-CSS/StaffDashboardFahad.css">
    <link rel="stylesheet" href="../FCMS-CSS/EventExecutionWorkflow.css" />
    <!-- Link to navbar css -->
    <link rel="stylesheet" href="../FCMS-CSS/AdminNav.css">
    <title>Order Details</title>
    <style>
        .dropdown .dropbtn {
            font-size: 20px;
            /* Adjust the font size as needed */
        }

        .order-details-content {
            margin-left: 100px;
        }

        .edit-delete-buttons {
            display: flex;
            gap: 10px;
            /* Adjust the gap between buttons as needed */
            margin-top: 10px;
            /* Add margin for spacing */
            margin-left: 150px;
        }
    </style>
</head>

<body>

    <div id="header">
        <h1>Order Details</h1>
    </div>
    <div class="navbar">
        <ul>


            <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="../FCMS-PHP/EventManagement.php">Events</a></li>
            <li><a href="../FCMS-PHP/manageMenu.php">Menu</a></li>
            <li><a href="../FCMS-PHP/AdminCreateStaff.php">Staff</a></li>


            <div class="dropdown">
                <button onclick="myFunction()" class="dropbtn" style="font-size: 15;">Statistics</button>
                <div id="myDropdown" class="dropdown-content">
                    <li><a href="../FCMS-PHP/StaffStatistic.php">Staff</a></li>
                    <li><a href="../FCMS-PHP/OrderStatistic.php">Orders</a></li>
                    <li><a href="../FCMS-PHP/CustomerStatistics.php">Customers</a></li>
                    <li><a href="../FCMS-PHP/RevenueStatistic.php">Profits</a></li>
                </div>

                <!-- <br><br><br><br> -->

            </div>
            <!-- <li><a class="back-button" href="javascript:history.back()">Go Back</a></li> -->



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



        </ul>
    </div>
    <!-- Navbar
    <nav>
        <a href="#" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
        <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="AdminPendingRequests.php">Pending Requests</a></li>
            <li><a href="AdminActiveOrder">Active Orders</a></li>
        </ul>
    </nav> -->


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
            } else {
                echo "Order not found.";
            }
        } else {
            echo "Order ID not provided.";
        }

        // // Handle form submission
        // if (isset($_POST['saveButton'])) {
        //     // Get the selected employees and update the "AssignedEmployees" field in the "Orders" table
        //     $assignedEmployees = '';
        //     foreach ($occupations as $occupation) {
        //         if (isset($_POST[$occupation])) {
        //             $selectedEmployee = $_POST[$occupation];
        //             $assignedEmployees .= "$selectedEmployee ($occupation), ";
        //         }
        //     }

        //     // Remove the trailing comma and space
        //     $assignedEmployees = rtrim($assignedEmployees, ', ');

        //     $updateQuery = "UPDATE Orders SET AssignedEmployees = '$assignedEmployees' WHERE OrderID = $orderID";

        //     if ($conn->query($updateQuery) === TRUE) {
        //         echo "Assigned employees saved successfully for Order #$orderID.";
        //     } else {
        //         echo "Error updating record: " . $conn->error;
        //     }
        // }

        if (isset($_POST['deleteButton'])) {
            $deleteQuery = "DELETE FROM Orders WHERE OrderID = $orderID";

            if ($conn->query($deleteQuery) === TRUE) {
                echo "Order deleted successfully.";
                // Redirect to a page after deletion
                header("Location: AdminActiveOrders.php");
                exit();
            } else {
                echo "Error deleting order: " . $conn->error;
            }
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
    <!-- <div class="board">
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
    </div> -->
    <div class="edit-delete-buttons">
        <!-- <button onclick="document.location=AdminEditOrder.php?orderID=" class="edit-button">Edit</button> -->
        <!-- <a href="AdminEditOrder.php?orderID=<?php echo $orderID; ?>" class="edit-button">Edit</a> -->
        <a href="AdminEditOrder.php?orderID=<?php echo $orderID; ?>"><button type="button" class="edit-button">Edit</button></a>
        <!-- <button type="submit" name="deleteButton">Delete</button> -->
        <form method="post" action="">
            <input type="hidden" name="orderID" value="<?php echo $orderID; ?>">
            <button type="submit" name="deleteButton">Delete</button>
        </form>
    </div>
    <script src="../FCMS-JavaScripts/EventExecutionWorkflow.js" defer></script>
</body>

</html>