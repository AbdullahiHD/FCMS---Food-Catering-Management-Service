<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>FCMS</title>
    <link rel="stylesheet" href="../FCMS-CSS/paymentgateway.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
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

    <h1 class="textpayment">Payment Successful</h1>
    <p class="Thankyou">
    Thank you for your recent payment. Your transaction was successfully processed. We greatly value your business and would appreciate your feedback on your experience.
     Please consider leaving a review on our website to help us improve and serve you better in the future.
    </p>


    <a class="feedbackbutton" href="Feedback and Reviewing Page.php">FeedBack</a>
    


    
</body>
</html>






<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "FCMS";

// Check if the session variable exists
if (isset($_SESSION['orderDetails'])) {
    // Retrieve the order details from the session
    $orderDetails = $_SESSION['orderDetails'];

    // Clear the session data to avoid displaying it again on refresh
    unset($_SESSION['orderDetails']);

    // Redirect to another page (replace 'AnotherPage.php' with your desired page)
    header('Location: Feedback and Reviewing Page.php');
    exit(); // Prevent further script execution after redirection
} //else {
    // Redirect to an error page or display an error message if the session data is missing
   // echo "Session data not found. Please check your session handling.";
//}
?>






