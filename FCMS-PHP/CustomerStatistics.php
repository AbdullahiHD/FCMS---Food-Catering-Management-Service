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
        .dropdown .dropbtn {
            font-size: 20px;
            /* Adjust the font size as needed */
        }
    </style>
</head>

<body>
    <div id="header">
        <h1>Customer Statictics</h1>
    </div>
    <div class="navbar">
        <ul>
            <br>
            <br>
            <br>
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

    <!-- Brief Heading and content -->
    <div class="hcontent">
        <br><br><br>
        <h1> Customer Statistics</h1>
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

    <button class="sortAsc-button">Sort - Ascending </button>
    <button class="sortDesc-button">Sort - Descending</button>


    <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
    <footer class="footer">
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-facebook"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-twitter"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-linkedin"></ion-icon>
                </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                    <ion-icon name="logo-instagram"></ion-icon>
                </a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="../FCMS-HTML/TahaIndex.html">Home</a></li>
            <li class="menu__item"><a class="menu__link" href="../FCMS-HTML/TahaIndex.html">Menu</a></li>
            <li class="menu__item"><a class="menu__link" href="../FCMS-HTML/TahaIndex.html">About</a></li>
            <li class="menu__item"><a class="menu__link" href="../FCMS-HTML/TahaIndex.html">Our Team</a></li>
            <li class="menu__item"><a class="menu__link" href="../FCMS-HTML/TahaIndex.html">Contact</a></li>
        </ul>

    </footer>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>