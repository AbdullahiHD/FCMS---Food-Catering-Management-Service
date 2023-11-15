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

                // Fetch relevant data from 'Requests' table
                $requestDataSql = "SELECT RequestID, MenuID, NumberOfAttendees FROM Requests";
                $requestDataResult = $conn->query($requestDataSql);

                if ($requestDataResult === FALSE) {
                    echo "Error: " . $conn->error;
                } else {
                    $requestDataRows = $requestDataResult->fetch_all(MYSQLI_ASSOC);

                    if (empty($requestDataRows)) {
                        echo "Error: No rows returned from the Requests table. SQL: $requestDataSql <br>";
                    } else {
                        foreach ($requestDataRows as $requestData) {
                            $requestID = $requestData['RequestID'];
                            $menuID = $requestData['MenuID'];
                            $numberOfAttendees = $requestData['NumberOfAttendees'];

                            // Fetch 'MenuName' from 'Menus' table
                            $menuNameSql = "SELECT MenuName FROM Menus WHERE MenuID = $menuID";
                            $menuNameResult = $conn->query($menuNameSql);

                            if ($menuNameResult === FALSE) {
                                echo "Error: " . $conn->error;
                            } else {
                                $menuNameRows = $menuNameResult->fetch_all(MYSQLI_ASSOC);

                                if (empty($menuNameRows)) {
                                    echo "Error: No corresponding MenuID found in the Menus table for the given MenuID. SQL: $menuNameSql <br>";
                                } else {
                                    // Use the first row (assuming MenuID is unique)
                                    $menuName = $menuNameRows[0]['MenuName'];

                                    // Fetch 'UnitPrice' from 'Menus' table
                                    $unitPriceSql = "SELECT Price FROM Menus WHERE MenuID = $menuID";
                                    $unitPriceResult = $conn->query($unitPriceSql);

                                    if ($unitPriceResult === FALSE) {
                                        echo "Error: " . $conn->error;
                                    } else {
                                        $unitPriceRows = $unitPriceResult->fetch_all(MYSQLI_ASSOC);

                                        if (empty($unitPriceRows)) {
                                            echo "Error: No corresponding MenuID found in the Menus table for the given MenuID. SQL: $unitPriceSql <br>";
                                        } else {
                                            // Use the first row (assuming MenuID is unique)
                                            $unitPrice = $unitPriceRows[0]['Price'];

                                            // Calculate TotalPrice based on NumberOfAttendees and UnitPrice
                                            $totalPrice = $numberOfAttendees * $unitPrice;

                                            // Insert relevant data into the "Sales" table
                                            $salesSql = "INSERT INTO Sales (CustomerName, OrderID, MenuID, MenuName, UnitPrice, TotalPrice, CreatedAt, UpdatedAt)
                                SELECT CustomerName, OrderID, $menuID, '$menuName', $unitPrice, $totalPrice, NOW(), NOW()
                                FROM Orders
                                WHERE OrderID = LAST_INSERT_ID()";

                                            if ($conn->query($salesSql) === TRUE) {
                                                // Sales data successfully inserted
                                                echo '<script>alert("Requests have been transferred to Orders and Sales.");</script>';
                                            } else {
                                                echo "Error: " . $salesSql . "<br>" . $conn->error;
                                            }
                                        }
                                    }


                                    if ($conn->query($salesSql) === TRUE) {
                                        // Sales data successfully inserted
                                        echo '<script>alert("Requests have been transferred to Orders and Sales.");</script>';
                                    } else {
                                        echo "Error: " . $salesSql . "<br>" . $conn->error;
                                    }
                                }
                            }
                        }
                    }
                }
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
                echo '<h3 class="request-title">Request #' . $row['RequestID'] . '</h3>';

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