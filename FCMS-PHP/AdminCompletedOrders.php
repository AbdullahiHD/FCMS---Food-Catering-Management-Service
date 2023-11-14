<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="../FCMS-CSS/StaffDashboardFahad.css">
    <!-- Link to navbar css -->
    <link rel="stylesheet" href="../FCMS-CSS/AdminNav.css">
    <title>Active Orders</title>
    <style>
        .dropdown .dropbtn {
            font-size: 20px;
            /* Adjust the font size as needed */
        }

        .orders-content {
            margin-left: 300px;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <!-- <nav>
        <a href="#" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="AdminPendingRequests.php">Pending Requests</a></li>
            <li><a href="#">Active Orders</a></li>
        </ul>
    </nav> -->
    <div id="header">
        <h1>Completed Orders</h1>
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


    <!-- Content for Active Orders page -->
    <div class="orders-content">


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
        $sql = "SELECT * FROM Orders WHERE OrderStatus = 'Complete'";
        $result = $conn->query($sql);

        // Check if there are any active orders
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orderID = $row['OrderID'];
                echo '<div class="order-div">';
                echo '<div class="order-content-active">';
                echo '<div class="order-title">Order #' . $orderID . '</div>';
                echo '<a href="AdminOrderDetailsPage.php?orderID=' . $orderID . '">View Order Details and Task Assignment</a>';
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