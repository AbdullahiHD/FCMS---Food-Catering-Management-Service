

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

// Fetching usernames for JavaScript validation
$usernames = array();
$result = $conn->query("SELECT username FROM users");
while($row = $result->fetch_assoc()) {
    $usernames[] = $row['username'];
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username = filter_var($_POST["husername"], FILTER_SANITIZE_STRING);
    $password = $_POST["hpass"];
    $confpass = $_POST["hconfpass"];

    $username_err = $password_err = $confpass_err = "";

    // Check if the username already exists
    $sql = "SELECT UserId FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $username_err = "Username is already taken.";
    }

    if (empty($username_err) && empty($password_err) && empty($confpass_err)) {
        // Hashing the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Inserting the user details into the users table
        $insert_sql = "INSERT INTO users (username, password, permission) VALUES (?, ?, 'Customer')";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("ss", $username, $hashed_password);

        if ($insert_stmt->execute()) {
            echo '<script>alert("Registration successful. You can now continue to create your profile.");</script>';
            echo '<script>window.location = "CustomerDetails.php";</script>';
        } else {
            echo "Error: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    } else {
        echo $username_err;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Online Food and Beverage Catering Service">
    <meta name="keywords" content="Create Customer Account">
    <meta name="author" content="Abdullahi">
    <title>Creating Customer Account</title>
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="../FCMS-CSS/CreateDetails.css">
    <!-- <link rel="stylesheet" href="../FCMS-CSS/Tahastyle.css"> -->
    <script>
        var existingUsernames = <?php echo json_encode($usernames); ?>;
    </script>
    <script src="../FCMS-JavaScripts/Validation.js"></script>
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
    <div class="general-layout">
        <div class="hcontent">
            <br><br><br><br>
            <h1>Sign Up</h1>
        </div>
        <form id="form" method="post" action="SignUp.php" novalidate="novalidate" onsubmit="return validateSignUp()">
            <fieldset>
                <legend class="leg">Login Details</legend>
                <input type="text" id="husername" name="husername" placeholder="Username"> <br>
                <div class="error-container">
                    <span id="username_err" class="error-message"></span>
                </div>

                <input type="password" id="hpass" name="hpass" placeholder="Password (8 characters)"> <br>
                <div class="error-container">
                    <span id="password_err" class="error-message"></span>
                </div>

                <input type="password" id="hconfpass" name="hconfpass" placeholder="Confirm Password"> <br>
                <div class="error-container">
                    <span id="confpass_err" class="error-message"></span>
                </div>
            </fieldset>
            <div class="button-container">
                <button type="submit" value="Submit" name="submit">Submit</button>
                <button type="reset" value="Reset">Reset</button>
            </div>
        </form>
    </div>

</body>

</html>

<?php
// Closing the database connection
$conn->close();
?>

