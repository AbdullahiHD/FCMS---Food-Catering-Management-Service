<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="../FCMS-CSS/StaffDashboardFahad.css">
    <title>Staff Profile</title>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <a href="#" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="../FCMS-chatapp/users.php">Chat</a></li>
            <li><a href="StaffDashboardFahad.php">Dashboard</a></li>
            <li><a href="StaffPendingRequestsFahad.php">Pending Requests</a></li>
            <li><a href="StaffActiveOrdersFahad.php">Active Orders</a></li>
            <li><a href="StaffProfilePage.php">Profile</a></li>
            <li><a href="Guides.php">Guides</a></li>
        </ul>
    </nav>

    <!-- Staff Profile content -->
    <div class="profile-content">
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
                if ($permission === 'Staff') {
                    // Query to fetch staff-specific information from the "staff" table
                    $staffQuery = "SELECT * FROM Staff WHERE UserId = $userId";
                    $staffResult = $conn->query($staffQuery);

                    if ($staffResult && $staffResult->num_rows > 0) {
                        $staff = $staffResult->fetch_assoc();

                        // Display user and staff details here
                        echo '<h1>User Profile</h1>';

                        // Display image if available

                        $imagePath = $staff["image"];
                        echo '    <img class="staff-img" src="' . $imagePath . '">';

                        echo '<p><strong>First Name:</strong> ' . $staff['FirstName'] . '</p>';
                        echo '<p><strong>Last Name:</strong> ' . $staff['LastName'] . '</p>';
                        echo '<p><strong>Joining Date:</strong> ' . $staff['JoiningDate'] . '</p>';
                        echo '<p><strong>Position:</strong> ' . $staff['Position'] . '</p>';

                        echo '<p><strong>User ID:</strong> ' . $user['UserId'] . '</p>';
                        echo '<p><strong>Username:</strong> ' . $user['Username'] . '</p>';
                        // echo '<p><strong>Permission:</strong> ' . $user['Permission'] . '</p>';

                        echo '<div class="logout-button"><button onclick="window.location.href=\'Login.php\'">Logout</button></div>';

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
    </div>

</body>
</html>

