<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "FCMS";

// Connect to MySQL server
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Select the database
if (!mysqli_select_db($conn, $databaseName)) {
    die("Database selection failed: " . mysqli_error($conn));
}

// Function to get the count from a table
function getCount($conn, $tableName, $condition)
{
    $countQuery = "SELECT COUNT(*) as count FROM $tableName WHERE $condition";
    $result = mysqli_query($conn, $countQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    } else {
        return 0; // Set a default value if there's an error or no records.
    }
}



function reqgetCount($conn, $tableName)
{
    $countQuery = "SELECT COUNT(*) as count FROM $tableName";
    $result = mysqli_query($conn, $countQuery);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        die("Error fetching result: " . mysqli_error($conn));
    }

    return $row['count'];
}

// Get the counts for active orders and requests
$activeOrdersCount = getCount($conn, "Orders", "OrderStatus = 'Active'");
// $activeRequestsCount = getCount($conn, "Requests", "RequestStatus = 'Active'");
$requestsCount = reqgetCount($conn, "Requests");
$completedorders = getCount($conn, "Orders", "OrderStatus = 'Complete'");

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Food and Beverage Catering Service">
    <meta name="keywords" content="EventManagement">
    <meta name="author" content="Abir">
    <title>Event Management</title>

    <!-- Link the general layout css -->
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">

    <!-- Link to this page's css -->
    <!-- <link rel="stylesheet" href="../FCMS-CSS/CreateDetails.css"> -->

    <!-- Including D3 Library -->
    <script src="https://d3js.org/d3.v6.min.js"></script>

    <!-- Link to navbar css -->
    <link rel="stylesheet" href="../FCMS-CSS/AdminNav.css">
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



        #boxes {
            display: flex;
            margin-top: 250px;
            margin-left: 350px;
        }

        .box {
            background-color: #3b3d41;
            width: 300px;
            height: 300px;
            border: 1px solid #666666;
            color: goldenrod;
            margin: 10px;
            padding: 10px;
            text-align: center;
            border-radius: 10px;
        }

        .box h2 {
            margin: 0;
        }

        .box p {
            background-color: #3b3d41;
            margin: 10px 0;
            font-size: 18pt;
        }

        .box button {
            padding: 10px 20px;
            margin-top: 20px;
            border: none;
            background-color: goldenrod;
            color: #333;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;

            align-self: flex-end;
        }
    </style>
</head>

<body>
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
    <!-- <div id="header">
        <h1>Event Management</h1>
    </div>
    <div class="navbar">
        <ul>

            <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="../FCMS-PHP/EventManagement.php">Events</a></li>
            <li><a href="../FCMS-PHP/manageMenu.php">Menu</a></li>
            <li><a href="../FCMS-PHP/AdminCreateStaff.php">Staff</a></li>

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
        </ul>
    </div> -->


    <div id="boxes">
        <div class="box">
            <h2>Active Orders</h2>
            <p><?php echo $activeOrdersCount; ?></p>

            <a href="AdminActiveOrders.php"><button>View</button></a>

        </div>
        <div class="box">
            <h2>Pending Requests</h2>
            <p><?php echo $requestsCount; ?></p>

            <a href="AdminPendingRequests.php"><button>View</button></a>

        </div>
        <div class="box">
            <h2>Completed Orders</h2>
            <p><?php echo $completedorders; ?></p>

            <a href="AdminCompletedOrders.php"><button>View</button></a>

        </div>
    </div>



</body>

</html>