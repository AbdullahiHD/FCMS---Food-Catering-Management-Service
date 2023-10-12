









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Food and Beverage Catering Service">
    <meta name="keywords" content="Create Customer Account">
    <meta name="author" content="Abdullahi">
    <title>Creating Customer Account</title>

    <!-- Link the general layout CSS -->
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">

    <!-- Link to this page's CSS -->
    <link rel="stylesheet" href="../FCMS-CSS/CreateDetails.css">

    <!-- Link the navbar style CSS -->
    <link rel="stylesheet" href="../FCMS-CSS/Tahastyle.css">

    <script>
        function validateSignUp() {
            var username = document.forms["form"]["husername"].value;
            var password = document.forms["form"]["hpass"].value;
            var confpass = document.forms["form"]["hconfpass"].value;
            var usernameRegex = /^[A-Za-z]{1,20}$/;

            // Reset previous error messages
            document.getElementById("username_err").textContent = "";
            document.getElementById("password_err").textContent = "";
            document.getElementById("confpass_err").textContent = "";

            // Validate username
            if (username === "") {
                document.getElementById("username_err").textContent = "Username is required.";
                return false;
            } else if (!username.match(usernameRegex)) {
                document.getElementById("username_err").textContent = "Username should only contain alphabetic characters and be up to 20 characters long.";
                return false;
            }

            // Validate password
            if (password === "") {
                document.getElementById("password_err").textContent = "Password is required.";
                return false;
            } else if (password.length < 8) {
                document.getElementById("password_err").textContent = "Password should be at least 8 characters long.";
                return false;
            }

            // Validate confirm password
            if (confpass === "") {
                document.getElementById("confpass_err").textContent = "Confirm Password is required.";
                return false;
            } else if (confpass !== password) {
                document.getElementById("confpass_err").textContent = "Passwords do not match.";
                return false;
            }
            return true;
        }
    </script>
</head>

<body>
    <header>
        <nav>
            <!-- Adding logo -->
            <a href="#" class="logolink">
                <img src="../FCMS-Assets/images/culinarycue.png" width="160" height="30" alt="CulinaryCue - Home">
            </a>
            <ul>
                <li><a href="">Home</a></li>
                <li><a href="">Menu</a></li>
                <li><a href="">About</a></li>
                <li><a href="">Contact</a></li>
            </ul>
            <a href="" class="registrationbutton">Login</a>
        </nav>
    </header>
    <div class="general-layout">
        <div class="hcontent">
            <h1>Customer Profile Creation</h1>
        </div>
        <form id="form" method="post" action="SignUp.php" novalidate="novalidate" onsubmit="return validateSignUp()">
            <!-- Fieldset3-Login -->
            <fieldset>
                <legend class="leg"> Login Details</legend>
                <input type="text" name="husername" placeholder="Username"> <br>
                <span id="username_err" class="error-message"></span>

                <input type="password" name="hpass" placeholder="Password"> <br>
                <span id="password_err" class="error-message"></span>

                <input type="password" name="hconfpass" placeholder="Confirm Password"> <br>
                <span id="confpass_err" class="error-message"></span>
            </fieldset>
            <!-- Buttons -->
            <div class="button-container">
                <button type="submit" value="Submit" name="submit">Submit</button>
                <button type="reset" value="Reset">Reset</button>
            </div>
        </form>
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
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$username = $password = $confpass = "";
$username_err = $password_err = $confpass_err = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Sanitize input
    $username = filter_var($_POST["husername"], FILTER_SANITIZE_STRING);
    $password = $_POST["hpass"];
    $confpass = $_POST["hconfpass"];

    // Check if the username already exists
    $sql = "SELECT UserId FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) 
    {
        $username_err = "Username is already taken.";
    }

    $stmt->close();

    // If there are no errors, proceed with registration
    if (empty($username_err) && empty($password_err) && empty($confpass_err)) 
    {
        // Hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Inserting the user details into the users table
        $insert_sql = "INSERT INTO users (username, password, permission) VALUES (?, ?, 'Customer')";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ss", $username, $hashed_password);

        if ($insert_stmt->execute()) 
        {
            echo '<script>alert("Registration successful. You can now continue to create your profile.");</script>';
            echo '<script>window.location = "CustomerDetails.php";</script>';
        } else {
            echo "Error: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }
}

// Closing the database connection
$conn->close();
?>
