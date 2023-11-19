<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Food and Beverage Catering Service">
    <meta name="keywords" content="Create Customer Account">
    <meta name="author" content="Abdullahi">
    <title>Customer Statistic Page</title>

    <!-- Link the general layout css -->
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">

    <!-- Link to this page's css -->
    <link rel="stylesheet" href="../FCMS-CSS/CreateDetails.css">

    <!-- Including D3 Library -->
    <script src="https://d3js.org/d3.v6.min.js"></script>

    <!-- Link to navbar css -->
    <link rel="stylesheet" href="../FCMS-CSS/AdminNav.css">
    <style>
        body {background-image: url(../FCMS-Assets/images/hero-slider-1.jpg);}
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

    <!-- Brief Heading and content -->
    <div class="hcontent">
    <h1 style="margin-top: 150px;">Customer Statistic</h1>
        
        <div class="page-description">
            <h4>Customer Frequency and Retention Visualization<br> The customers total number of orders against individual customer <br> For More Interactivity Use the sort buttons as well data mouse over on bars </h4> 
        </div>
         <button class="sortAsc-button">Sort - Ascending </button>
        <button class="sortDesc-button">Sort - Descending</button>
    </div>
        

    <div id="chart-container">
        <svg id="bar-chart"></svg>
    </div>

    <!-- Your PHP script for database connection and data fetching should be placed here. -->
    <?php
    // Database configuration
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "FCMS";

    // Create database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to retrieve customer names and their number of orders
    $sql = "SELECT FirstName, LastName, NumberOfOrders 
            FROM customers 
            WHERE NumberOfOrders >= 3 
            ORDER BY NumberOfOrders DESC";
    $result = $conn->query($sql);

    $customerOrderData = array();
    while ($row = $result->fetch_assoc()) {
        $customerOrderData[] = $row;
    }

    // Free result set
    $result->close();

    // Close connection
    $conn->close();

    // Print the data in JSON format
    echo "<script>var customerOrderData = " . json_encode($customerOrderData) . ";</script>";
    // echo json_encode($customerOrderData)
    ?>


    <!-- Including Validation and D3 scripts -->
    <script src="../FCMS-JavaScripts/Validation.js"></script>
    <script src="../FCMS-JavaScripts/CustomerD3.js"></script>

    


    <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
    <footer class="footer">
        <ul class="social-icon">
            <li class="social-icon_item"><a class="social-icon_link" href="#">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a></li>
            <li class="social-icon_item"><a class="social-icon_link" href="#">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a></li>
            <li class="social-icon_item"><a class="social-icon_link" href="#">
                    <ion-icon name="logo-linkedin"></ion-icon>
                </a></li>
            <li class="social-icon_item"><a class="social-icon_link" href="#">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a></li>
        </ul>
        <ul class="menu">
            <li class="menu_item"><a class="menu_link" href="../FCMS-HTML/TahaIndex.html">Home</a></li>
            <li class="menu_item"><a class="menu_link" href="../FCMS-HTML/TahaIndex.html">Menu</a></li>
            <li class="menu_item"><a class="menu_link" href="../FCMS-HTML/TahaIndex.html">About</a></li>
            <li class="menu_item"><a class="menu_link" href="../FCMS-HTML/TahaIndex.html">Our Team</a></li>
            <li class="menu_item"><a class="menu_link" href="../FCMS-HTML/TahaIndex.html">Contact</a></li>
        </ul>

    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>