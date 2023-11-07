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
function getCount($conn, $tableName, $condition) {
    $countQuery = "SELECT COUNT(*) as count FROM $tableName WHERE $condition";
    $result = mysqli_query($conn, $countQuery);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    } else {
        return 0; // Set a default value if there's an error or no records.
    }
}

// Get the counts for active orders and requests
$activeOrdersCount = getCount($conn, "Orders", "OrderStatus = 'Active'");
$activeRequestsCount = getCount($conn, "Requests", "RequestStatus = 'Active'");

// Close the database connection
mysqli_close($conn);
?>

<html>

<head>
    <title>Event Managment</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="theme.css" type="text/css" />
    <style>
        body {
            margin: 0;
            background-color: #000000;
        }

        #header {
            background-image: url("background.png");
            background-color: #000000;
            height: 100px;
            color: #FFFFFF;
            text-align: left;
            padding-left: 20px;
            padding-top: 20px;
            font-family: "Arial";
            color: goldenrod;
        }

        #nav {
            background-color: #3b3d41;
            color: goldenrod;
            min-height: 83vh;
            /* Set minimum height to cover the entire viewport */
            width: 150px;
            float: left;
            padding: 5px;
        }

        #section {
            width: 500px;
            float: left;
            padding: 10px;
        }

        ul {
            list-style-type: none;
            color: goldenrod;
            margin: 0;
            padding: 0;
            width: 100%;
            background-color: #3b3d41;
        }

        li a {
            font-family: Calibri;
            font-size: 14pt;
            font-style: none;
            display: block;
            color: #FFFFFF;
            padding: 8px 0 8px 16px;
            text-decoration: none;
            color: goldenrod;
        }

        li a:visited {
            background-color: #4CAF50;
            color: #FFFFFF;
        }

        li a:hover {
            background: hsla(180, 2%, 8%, 1);
            color: #ffffff;
        }

        #boxes {
            display: flex;
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
        }

        .box h2 {
            margin: 0;
        }

        .box p {
            background-color: #3b3d41;
            margin: 10px 0;
        }

        .box button {
            background-color: goldenrod;
            color: white;
            font-family: 'Franklin Gothic Medium', sans-serif;
            text-decoration: none;
            border: 2px dotted transparent;
            font-weight: bold;
            padding: 10px 25px;
            border-radius: 40px;
            align-self: flex-end;
        }
    </style>
</head>

<body>

    <div id="header">
        <h1>Event managment</h1>
    </div>

    <div id="nav">
        <ul>
            <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="#">Event</a></li>
            <li><a href="../FCMS-PHP/menu.php">Menu</a></li>
            <li><a href="#">Statistics</a></li>
        </ul>
    </div>

    <div id="boxes">
        <div class="box">
            <h2>Active Orders</h2>
            <p><?php echo $activeOrdersCount; ?></p>
            
            <a href="AdminActiveOrders.php"><button>View</button></a>
            
        </div>
        <div class="box">
            <h2>Active Requests</h2>
            <p><?php echo $activeRequestsCount; ?></p>
            
            <a href="AdminPendingRequests.php"><button>View</button></a>
            
        </div>
    </div>

    <div id="section">

    </div>


</body>

</html>