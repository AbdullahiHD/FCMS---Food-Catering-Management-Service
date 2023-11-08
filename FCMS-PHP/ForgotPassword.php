<?php
session_start();

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

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $newPassword = $_POST['newpassword'];
    $confirmNewPassword = $_POST['confirmnewpassword'];

    // Check if the new password and confirmation match
    if ($newPassword != $confirmNewPassword) {
        echo '<script>alert("New password and confirmation do not match. Please try again.");</script>';
    } else {
        // Query to check if the username exists in the database
        $sql = "SELECT * FROM users WHERE Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {

            // Hash the new password before storing it in the database
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the user's password in the database
            $updateSql = "UPDATE users SET Password = ? WHERE Username = ?";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->bind_param("ss", $hashedPassword, $username);
            $updateStmt->execute();
            $updateStmt->close();

            // Display the new password in a JavaScript alert
            echo '<script>alert("Your new password: ' . $newPassword . '");</script>';
            header("Location: ../FCMS-PHP/Login.php");
        } else {
            // Username not found
            echo '<script>alert("Username not found. Please try again.");</script>';
        }

        $stmt->close(); // Close the statement here
    }

    // Close the database connection
    $conn->close();
}
?>

<html>
<style>
    nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 0px;
        padding-bottom: 0px;
        padding-left: 8%;
        padding-right: 8%;
        background-color: rgb(11, 11, 10);
        position: fixed;
        /* This makes the navbar fixed at the top */
        top: 0;
        /* Position it at the top of the viewport */
        left: 0;
        /* Position it at the left of the viewport */
        width: 100%;
        /* Ensure it takes the full width */
        z-index: 1000;
        /* This ensures the navbar is always on top of other content */
    }

    span {
        color: goldenrod;
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
        /* ... (rest of your styles) */
    }

    /* Before and After pseudo-elements represent the two lines */
    nav ul li a::before,
    nav ul li a::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        /* Height of the line */
        background-color: goldenrod;
        /* Line color */
        transition: all 0.3s ease;
    }

    /* First line appears from the left */
    nav ul li a::before {
        bottom: 1px;
        /* Slight offset from the bottom to create gap between two lines */
    }

    /* Second line appears from the right */
    nav ul li a::after {
        bottom: -3px;
        /* Slight offset from the bottom */
        right: 0;
        left: auto;
        transform: scaleX(-1);
        /* Invert it to make it appear from right */
    }

    /* On hover, the lines animate to full width */
    nav ul li a:hover::before,
    nav ul li a:hover::after {
        width: 100%;
    }


    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Set background and primary font color */
    body {
        background-color: #202020;
        color: #D6D6D6;
        font-family: Arial, sans-serif;

        background-image: url('../FCMS-Assets/images/hero-slider-1.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        margin: 0;
    }

    ::selection {
        background: rgba(26, 188, 156, 0.3);
    }

    .container {
        max-width: 440px;
        padding: 0 20px;
        margin: 170px auto;
    }

    .wrapper {
        width: 100%;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.1);
    }

    .wrapper .title {
        height: 90px;
        background: rgb(255, 255, 255);
        border-radius: 5px 5px 0 0;
        color: #000000;
        font-size: 30px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wrapper form {
        padding: 30px 25px 25px 25px;
    }

    .wrapper form .row {
        height: 45px;
        margin-bottom: 15px;
        position: relative;
    }

    .wrapper form .row input {
        height: 100%;
        width: 100%;
        outline: none;
        padding-left: 60px;
        border-radius: 5px;
        border: 1px solid lightgrey;
        font-size: 16px;
        transition: all 0.3s ease;
    }

    form .row input:focus {
        border-color: #16a085;
        box-shadow: inset 0px 0px 2px 2px rgba(26, 188, 156, 0.25);
    }

    form .row input::placeholder {
        color: #999;
    }

    .wrapper form .row i {
        position: absolute;
        width: 47px;
        height: 100%;
        color: rgb(0, 0, 0);
        font-size: 18px;
        background: goldenrod;
        border: 1px solid hsla(0, 0%, 65%, 1);
        border-radius: 5px 0 0 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .wrapper form .pass {
        margin: -8px 0 20px 0;
    }

    .wrapper form .pass a {
        color: hsla(210, 4%, 11%, 1);
        font-size: 17px;
        text-decoration: none;
    }

    .wrapper form .pass a:hover {
        text-decoration: underline;
    }

    .wrapper form .button input {
        color: #000000;
        font-size: 20px;
        font-weight: 500;
        padding-left: 0px;
        background: goldenrod;
        border: 1px solid hsla(0, 0%, 65%, 1);
        cursor: pointer;
    }

    form .button input:hover {
        background: hsla(180, 2%, 8%, 1);
        color: #ffffff;

    }

    .wrapper form .signup-link {
        text-align: center;
        margin-top: 20px;
        font-size: 17px;
    }

    .wrapper form .signup-link a {
        color: #16a085;
        text-decoration: none;
    }

    form .signup-link a:hover {
        text-decoration: underline;
    }
</style>
<nav>

    <a href="../FCMS-HTML/TahaIndex.html" class="logolink">
        <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
    </a>
    <ul>
        <li><a href="../FCMS-HTML/TahaIndex.html">Home</a></li>
        <li><a href="../FCMS-HTML/menu.php">Menu</a></li>
        <li><a href="#Navabout">About</a></li>
        <li><a href="#Navteam">Our Team</a></li>
        <li><a href="#Navcontact">Contact</a></li>

    </ul>
    <a class="registrationbutton" href="CustomerLogin.html">Login</a>


</nav>

<body>

    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Forgot Password</span></div>
            <form method="post" action="ForgotPassword.php">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" id="username" name="username" placeholder="Username" required><br>
                </div>

                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="password" id="newpassword" name="newpassword" placeholder="New Password" required><br>
                </div>

                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="password" id="confirmnewpassword" name="confirmnewpassword" placeholder="Confirm New Password" required><br>
                </div>

                <div class="row button">
                    <input type="submit" name="submit" value="Submit">
                </div>
            </form>

        </div>

    </div>


</body>

</html>