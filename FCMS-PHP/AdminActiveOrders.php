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

        .dropdown .dropbtn {
            font-size: 20px;
            /* Adjust the font size as needed */
        }
    </style>

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