<?php
session_start();

// Check if the requestID is provided in the GET parameters
if (isset($_GET['requestID'])) {
    // Retrieve the requestID from the GET parameters
    $requestID = $_GET['requestID'];

    // Store the requestID in the session for future use
    $_SESSION['requestID'] = $requestID;
} else {
    // Handle the case where requestID is not present in the URL
    echo "RequestID not provided.";
}

?>

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
        </nav>
    </div>

    <h1 class="textpayment">Payment Successful</h1>
    <p class="Thankyou">
    Thank you for your recent payment. Your transaction was successfully processed. We greatly value your business and would appreciate your feedback on your experience.
     Please consider leaving a review on our website to help us improve and serve you better in the future.
    </p>

    <?php
    // Check if the requestID is set in the session
    if (isset($_SESSION['requestID'])) {
        // Output the feedback button with the requestID in the URL
        echo '<a class="feedbackbutton" href="Feedback and Reviewing Page.php?requestID=' . $_SESSION['requestID'] . '">FeedBack</a>';
    } else {
        // Handle the case where requestID is not set in the session
        echo "RequestID not found in the session.";
    }
    ?>

</body>
</html>
