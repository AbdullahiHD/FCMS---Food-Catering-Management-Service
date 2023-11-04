
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

    <!-- Including D3 Library -->
    <script src="https://d3js.org/d3.v6.min.js"></script>
    
    <script src="../FCMS-JavaScripts/CustomerD3.js"></script>

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
            <br><br>
            <h1> Customer Statistics</h1>
        </div>

        <div id="chart-container">
            <svg id="bar-chart"></svg>
        </div>

        <!-- <button class="sortAsc-button">Sort - Ascending </button>
        <button class="sortDesc-button">Sort - Descending</button>
        -->

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

// Fetch customer data
$sql = "SELECT Firstname, NumberOfOrders FROM customers WHERE DeletedAt IS NULL AND NumberOfOrders > 3";
$result = $conn->query($sql);

$customers = array();
if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $customers[] = $row;
  }
} else {
  echo "0 results";
}
$conn->close();

// Output data as JSON
// header('Content-Type: application/json');
// echo json_encode($customers);
// ?>