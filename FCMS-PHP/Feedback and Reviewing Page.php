<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "FCMS";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['requestID'], $_POST['feedback'])) {
    $requestID = $_POST['requestID'];
    $feedback = $_POST['feedback'];

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Update the record in the requests table with the feedback
    $sql = "UPDATE requests SET Comments = '$feedback' WHERE RequestID = $requestID";

    if ($conn->query($sql) === TRUE) {
        // Feedback successfully submitted
        // Redirect to a success page or perform other actions
        echo "<script>
            window.location.href = 'TestimonialPage.php';
        </script>";
        exit();
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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
            background-color: #202020;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            color: goldenrod;
            margin-top: 80px;
        }

        .feedback-form {
            max-width: 400px;
            margin: 0 auto;
        }

        .feedback-form label {
            display: block;
            margin-top: 80px;
            margin-bottom: 20px;
            color: goldenrod;
            font-size: 30px;
            margin-left: -200px;
        }

        .feedback-form input[type="text"],
        .feedback-form input[type="email"],
        .feedback-form input[type="tel"],
        .feedback-form textarea {
            width: 200%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
            margin-left: -210px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        button {
            background-color: goldenrod;
            color: black;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }

        button:hover {
            background-color: gold;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #202020;
        }

        .content {
            margin-left: 220px;
            padding: 20px;
            color: white;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space between;
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 8%;
            padding-right: 8%;
            background-color: rgb(11, 11, 10);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        nav ul li {
            list-style-type: none;
            display: inline-block;
            padding: 10px 25px;
        }

        nav ul li a {
            color: goldenrod;
            text-decoration: none;
            font-family: 'Franklin Gothic Medium', sans-serif;
            font-weight: bold;
            text-transform: capitalize;
            font-size: 17px;
        }

        .registrationbutton {
            background-color: goldenrod;
            color: white;
            font-family: 'Franklin Gothic Medium', sans-serif;
            text-decoration: none;
            border: 2px dotted transparent;
            font-weight: bold;
            padding: 10px 25px;
            border-radius: 40px;
            transition: transform .3s;
        }

        .registrationbutton:hover {
            transform: scale(1.1);
        }

        nav ul li a {
            position: relative;
        }

        nav ul li a::before,
        nav ul li a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: goldenrod;
            transition: all 0.3s ease;
        }

        nav ul li a::before {
            bottom: 1px;
        }

        nav ul li a::after {
            bottom: -3px;
            right: 0;
            left: auto;
            transform: scaleX(-1);
        }

        nav ul li a:hover::before,
        nav ul li a:hover::after {
            width: 100%;
        }
    </style>
</head>

<body>
    <header>
        <nav>
            <a href="#" class="logolink">
                <img src="../FCMS-Assets/images/culinarycue.png" width="100" height="60" alt="CulinaryCue - Home">
            </a>
            <ul>
                <li><a href="../FCMS-HTML/TahaIndex.html">Home</a></li>
                <li><a href="../FCMS-HTML/TahaIndex.html">Menu</a></li>
                <li><a href="../FCMS-HTML/TahaIndex.html">About</a></li>
                <li><a href="../FCMS-HTML/TahaIndex.html">Contact</a></li>
            </ul>
            <!-- <a href="../FCMS-PHP/Login.php" class="registrationbutton">Login</a> -->
        </nav>
    </header>
    <div class="container">
        <div class="feedback-form">
            <h1>Feedback Form</h1>
            <form method="POST" action="">
            <?php
                if (isset($_GET['requestID'])) {
                    $requestID = $_GET['requestID'];
                    echo '<input type="hidden" name="requestID" value="' . $requestID . '">';
                }
                ?>
                <label for="feedback">We appreciate your feedback:</label>
                <textarea id="feedback" name="feedback" rows="18"></textarea>
                <div class="button-container">
                        <button type="submit" name="submit">Submit Feedback</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

