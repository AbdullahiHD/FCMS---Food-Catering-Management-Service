<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fcms";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Start a session (if not already started)
session_start();

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Query to fetch user information from the "users" table
    $query = "SELECT * FROM users WHERE UserId = $userId";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $permission = $user['Permission'];

        // Check if the user is a staff member
        if ($permission === 'staff') {
            // Query to fetch staff-specific information from the "staff" table
            $staffQuery = "SELECT * FROM staff WHERE UserId = $userId";
            $staffResult = $conn->query($staffQuery);

            if ($staffResult && $staffResult->num_rows > 0) {
                $staff = $staffResult->fetch_assoc();

                // Display user and staff details here
                echo '<h1>User Profile</h1>';
                echo '<h2>User Information</h2>';
                echo '<p><strong>User ID:</strong> ' . $user['UserId'] . '</p>';
                echo '<p><strong>Username:</strong> ' . $user['Username'] . '</p>';
                echo '<p><strong>Email:</strong> ' . $user['Email'] . '</p>';
                echo '<p><strong>Permission:</strong> ' . $user['Permission'] . '</p>';

                echo '<h2>Staff Information</h2>';
                echo '<p><strong>First Name:</strong> ' . $staff['FirstName'] . '</p>';
                echo '<p><strong>Last Name:</strong> ' . $staff['LastName'] . '</p>';
                echo '<p><strong>Joining Date:</strong> ' . $staff['JoiningDate'] . '</p>';
                echo '<p><strong>Position:</strong> ' . $staff['Position'] . '</p>';
            } else {
                echo 'Staff information not found.';
            }
        } else {
            echo 'You do not have permission to view this page.';
        }
    } else {
        echo 'User not found.';
    }
} else {
    echo 'User not logged in.';
}

// Close the database connection
$conn->close();
?>
