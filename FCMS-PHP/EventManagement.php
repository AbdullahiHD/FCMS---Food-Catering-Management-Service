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
            /* background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;    */


            background-color: #3b3d41;
            color: goldenrod;
            height: 100%;
            min-height: 83vh;
            width: 210px;
            float: left;
            padding: 5px;
            top: 120;
            overflow-y: auto;
            position: fixed;
            /* position: fixed;
            top: 100;
            left: 0;
            overflow-y: auto; */
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
            font-size: 18pt;
            font-style: none;
            display: block;
            color: #FFFFFF;
            padding: 8px 0 8px 16px;
            text-decoration: none;
            color: goldenrod;
        }

       

        li a:hover {
            background: hsla(180, 2%, 8%, 1);
            color: #ffffff;
        }

        #boxes {
            display: flex;
            margin-top: -10px;
            margin-left: 240px;
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