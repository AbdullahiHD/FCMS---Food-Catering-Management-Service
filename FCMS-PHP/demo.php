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
            <!--  -->

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
$database = "FCMS";

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['eventTime'], $_POST['eventDate'], $_POST['deliveryAddress'], $_POST['attendees'], $_POST['menuId'])) {
    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // // Get data from the POST request
    // $name = $conn->real_escape_string($_POST['name']);
    // $eventTime = $conn->real_escape_string($_POST['eventTime']);
    // $eventDate = $conn->real_escape_string($_POST['eventDate']);
    // $deliveryAddress = $conn->real_escape_string($_POST['deliveryAddress']);
    // $attendees = $conn->real_escape_string($_POST['attendees']);
    // $menuId = $conn->real_escape_string($_POST['menuId']);

    // // Set default values for OrderStatus and PaymentStatus
    // $orderStatus = "Pending";
    // $paymentStatus = "Received";
    // $paymentID = "1";

    // SQL query to insert data into the "requests" table
    $sql = "INSERT INTO requests (CustomerName, EventTime, EventDate, DeliveryAddress, NumberOfAttendees, MenuID, OrderStatus, PaymentStatus, PaymentID)
            VALUES ('Ali', '13:00;00', '24/01/2028', 'Simpang', '100', '6', 'pending', 'pending', '1')";

    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully
        echo "Order Successful";
        // JavaScript for redirection and alert
        echo "<script>
            alert('Order Successful');
            window.location.href = 'menu.php';
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





