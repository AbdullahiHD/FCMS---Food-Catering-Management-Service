<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>FCMS</title>
    <link rel="stylesheet" href="../FCMS-CSS/paymentgateway.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script>
        function validateCardNumber() {
            const cardNumber = document.getElementById('card-number').value;
            if (!/^\d{1,16}$/.test(cardNumber)) {
                document.getElementById('card-number-error').textContent = 'Card number must be up to 16 digits.';
                return false;
            } else {
                document.getElementById('card-number-error').textContent = '';
                return true;
            }
        }

        function validateCardHolder() {
            const cardHolder = document.getElementById('card-holder').value;
            if (/\d/.test(cardHolder)) {
                document.getElementById('card-holder-error').textContent = 'Name must contain only letters.';
                return false;
            } else {
                document.getElementById('card-holder-error').textContent = '';
                return true;
            }
        }

        function validateExpiryMonth() {
            const expiryMonth = parseInt(document.getElementById('expiry-month').value);
            if (expiryMonth < 1 || expiryMonth > 12) {
                document.getElementById('expiry-month-error').textContent = 'Month must be between 1 and 12.';
                return false;
            } else {
                document.getElementById('expiry-month-error').textContent = '';
                return true;
            }
        }

        function validateExpiryYear() {
            const currentYear = new Date().getFullYear();
            const expiryYear = parseInt(document.getElementById('expiry-year').value);
            if (isNaN(expiryYear) || expiryYear < currentYear || expiryYear > currentYear + 10) {
                document.getElementById('expiry-year-error').textContent = 'Year must be between the current year and 10 years ahead.';
                return false;
            } else {
                document.getElementById('expiry-year-error').textContent = '';
                return true;
            }
        }

        function validateCvv() {
            const cvv = document.getElementById('cvv').value;
            if (!/^\d{1,3}$/.test(cvv)) {
                document.getElementById('cvv-error').textContent = 'CVV must be up to 3 digits.';
                return false;
            } else {
                document.getElementById('cvv-error').textContent = '';
                return true;
            }
        }

        function validateForm() {
            return validateCardNumber() && validateCardHolder() && validateExpiryMonth() && validateExpiryYear() && validateCvv();
        }
    </script>
</head>
<body>
    <div>
        <nav>
            <a href="TahaIndex.html" class="logolink">
                <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
            </a>
             <ul>
                <li><a href="../FCMS-HTML/TahaIndex.html">Home</a></li>
                <li><a href="../FCMS-PHP/menu.php">Menu</a></li>
                <li><a href="../FCMS-HTML/TahaIndex.html">About</a></li>
                <li><a href="../FCMS-HTML/TahaIndex.html">Our Team</a></li>
                <li><a href="../FCMS-HTML/TahaIndex.html">Contact</a></li>
            
            </ul>
            <!-- <a class="registrationbutton" href="Login.html">Profile</a> -->
        </nav>
    </div>

    <h1 class="textpayment">Payment Gateway</h1>

    <div class="container">
        <div class="card-form">
            <form method="POST" action="Paymentgateway.php"> <!-- Changed to POST method for secure data transmission -->
                <?php
                // Check if data was passed from the quotation and billing forms
                if (isset($_GET['name'], $_GET['eventType'], $_GET['eventTime'], $_GET['eventDate'], $_GET['deliveryAddress'], $_GET['attendees'], $_GET['menuId'], $_GET['menuName'], $_GET['menuPrice'], $_GET['totalPrice'])) {
                    // Output hidden input fields to store this data
                    echo '<input type="hidden" name="name" value="' . htmlspecialchars($_GET['name']) . '">';
                    echo '<input type="hidden" name="eventType" value="' . htmlspecialchars($_GET['eventType']) . '">';
                    echo '<input type="hidden" name="eventTime" value="' . htmlspecialchars($_GET['eventTime']) . '">';
                    echo '<input type="hidden" name="eventDate" value="' . htmlspecialchars($_GET['eventDate']) . '">';
                    echo '<input type="hidden" name="deliveryAddress" value="' . htmlspecialchars($_GET['deliveryAddress']) . '">';
                    echo '<input type="hidden" name="attendees" value="' . htmlspecialchars($_GET['attendees']) . '">';
                    echo '<input type="hidden" name="menuId" value="' . htmlspecialchars($_GET['menuId']) . '">';
                    echo '<input type="hidden" name="menuName" value="' . htmlspecialchars($_GET['menuName']) . '">';
                    echo '<input type="hidden" name="menuPrice" value="' . htmlspecialchars($_GET['menuPrice']) . '">';
                    echo '<input type="hidden" name="totalPrice" value="' . htmlspecialchars($_GET['totalPrice']) . '">';
                }
                ?>
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="cardNumber" oninput="validateCardNumber()">
                <span id="card-number-error" style="color:red;"></span>

                <label for="card-holder">Card Holder's Name</label>
                <input type="text" id="card-holder" name="cardHolder" oninput="validateCardHolder()">
                <span id="card-holder-error" style="color:red;"></span>

                <div class="expiry-cvv">
                    <div>
                        <label for="expiry-month">Expiration Month (MM)</label>
                        <input type="text" id="expiry-month" name="expiryMonth" oninput="validateExpiryMonth()">
                        <span id="expiry-month-error" style="color:red;"></span>

                        <label for="expiry-year">Expiration Year (YYYY)</label>
                        <input type="text" id="expiry-year" name="expiryYear" oninput="validateExpiryYear()">
                        <span id="expiry-year-error" style="color:red;"></span>
                    </div>

                    <div>
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" oninput="validateCvv()">
                        <span id="cvv-error" style="color:red;"></span>
                    </div>
                </div>

                <button type="submit" class="submitbutton" onclick="return validateForm();">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "fcms";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['eventTime'], $_POST['eventDate'], $_POST['deliveryAddress'], $_POST['attendees'], $_POST['menuId'])) {
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the POST request
    $name = $conn->real_escape_string($_POST['name']);
    $eventTime = $conn->real_escape_string($_POST['eventTime']);
    $eventDate = $conn->real_escape_string($_POST['eventDate']);
    $deliveryAddress = $conn->real_escape_string($_POST['deliveryAddress']);
    $attendees = $conn->real_escape_string($_POST['attendees']);
     // Extract numeric part from menuId
    $menuId = preg_replace('/\D/', '', $_POST['menuId']);

    // Set default values for OrderStatus and PaymentStatus
    $orderStatus = "Pending";
    $paymentStatus = "Received";
    $paymentID = "1";

    // SQL query to insert data into the "requests" table
    $sql = "INSERT INTO requests (CustomerName, EventTime, EventDate, DeliveryAddress, NumberOfAttendees, MenuID, OrderStatus, PaymentStatus, PaymentID)
            VALUES ('$name', '$eventTime', '$eventDate', '$deliveryAddress', '$attendees', '$menuId', '$orderStatus', '$paymentStatus', '$paymentID')";

    if ($conn->query($sql) === TRUE) {
        $requestID = $conn->insert_id;
        echo "<script>
            window.location.href = 'PaymentSuccessful.php?requestID=$requestID';
        </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // Handle the case where not all required parameters are set
    echo "Missing required parameters.";
}
?>





