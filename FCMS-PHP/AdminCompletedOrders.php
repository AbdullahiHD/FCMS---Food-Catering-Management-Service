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
        <a href="../FCMS-HTML/TahaIndex.html" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="../FCMS-PHP/EventManagement.php">Events</a></li>
            <li><a href="../FCMS-PHP/manageMenu.php">Menu</a></li>
            <li><a href="../FCMS-PHP/AdminCreateStaff.php">Staff</a></li>
            <li>
                <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn">Statistics</button>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="../FCMS-PHP/StaffStatistic.php">Staff</a>
                        <a href="../FCMS-PHP/OrderStatistic.php">Order</a>
                        <a href="../FCMS-PHP/CustomerStatistics.php">Customer</a>
                        <a href="../FCMS-PHP/RevenueStatistic.php">Profit</a>
                    </div>
                </div>
            </li>

        </ul>


        <script>
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }

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
    </nav>


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