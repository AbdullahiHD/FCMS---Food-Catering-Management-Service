
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Food and Beverage Catering Service">
    <meta name="keywords" content="Create Customer Account">
    <meta name="author" content="Abdullahi">
    <title>Creating Customer Account</title>

    <!-- Linl the general layout css -->
    <link rel="stylesheet" href="../FCMS-Assets/Main.css"> 

    <!-- Link to this pages css -->
    <link rel="stylesheet" href="../FCMS-CSS/CreateDetails.css">

    <!-- Link the navbar style css -->
    <!-- <link rel="stylesheet" href="../FCMS-CSS/Tahastyle.css"> -->

    <script src="../FCMS-JavaScripts/Validation.js"></script>

</head>

<body>
    <header>
        <!-- Navigation bar -->
        <nav>

            <!-- Adding logo -->
            <a href="#" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
            </a>
            <ul>
                <li><a href="../FCMS-HTML/TahaIndex.html">Home</a></li>
                <li><a href="../FCMS-HTML/TahaIndex.html">Menu</a></li>
                <li><a href="../FCMS-HTML/TahaIndex.html">About</a></li>
                <li><a href="../FCMS-HTML/TahaIndex.html">Contact</a></li>
            </ul>
            <!-- <a href="../FCMS-HTML/Login.html" class="registrationbutton">Login</a> -->

        </nav>
    </header>
    
        <!-- Brief Heading and content -->
        <div class="hcontent">
            <h1> Customer Statistics</h1>
        </div>
       

    
</body>

</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "FCMS";

// Create a new mysqli connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$fname = $lname = $email = $phone = $streetadd = $city = $state = $postcode = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $fname = filter_var($_POST["hfname"], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST["hlname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["hemail"], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($_POST["hphone"], FILTER_SANITIZE_STRING);
    $streetadd = filter_var($_POST["hstreetadd"], FILTER_SANITIZE_STRING);
    $city = filter_var($_POST["hcity"], FILTER_SANITIZE_STRING);
    $state = filter_var($_POST["hstate"], FILTER_SANITIZE_STRING);
    $postcode = filter_var($_POST["hpostcode"], FILTER_SANITIZE_STRING);

    // Inserting the user details into the database
    $insert_sql = "INSERT INTO customers (Firstname, Lastname, Email, Phone, `Address`, City, `State`, Postcode) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ssssssss", $fname, $lname, $email, $phone, $streetadd, $city, $state, $postcode);

    if ($insert_stmt->execute()) {
        echo '<script>alert("Registration successful. You can now proceed to login.");</script>';
        echo '<script>window.location = "../FCMS-PHP/Login.php";</script>';
    } else {
        echo "Error: " . $insert_stmt->error;
    }

    $insert_stmt->close();
}

// Close the database connection
$conn->close();
?>
