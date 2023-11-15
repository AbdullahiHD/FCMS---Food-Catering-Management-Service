<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="../FCMS-CSS/StaffDashboardFahad.css">
    <link rel="stylesheet" href="../FCMS-CSS/StaffCreateEmployee.css">
    <title>Your Web Application</title>

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

    <!-- Content -->
    <div class="content">
        <h1 id="dashboard-heading">Dashboard</h1>
        

        <div class="team-section">
            <h2>Staff Members</h2>
            <div class="team-container">
                <div class="team-member" data-role="Chef">
                    <img src="../FCMS-Assets/images/chef1.jpg" alt="Chef 1">
                    <div class="overlay"><span>Chef</span></div>
                </div>
                <div class="team-member" data-role="Chef">
                    <img src="../FCMS-Assets/images/chef2.jpg" alt="Chef 2">
                    <div class="overlay"><span>Chef</span></div>
                </div>
                <div class="team-member" data-role="Chef">
                    <img src="../FCMS-Assets/images/chef3.jpg" alt="Chef 3">
                    <div class="overlay"><span>Chef</span></div>
                </div>
                <div class="team-member" data-role="General Manager">
                    <img src="../FCMS-Assets/images/manager1.jpg" alt="General Manager">
                    <div class="overlay"><span>General Manager</span></div>
                </div>
                <div class="team-member" data-role="Operational Manager">
                    <img src="../FCMS-Assets/images/manager2.jpg" alt="Operational Manager">
                    <div class="overlay"><span>Operational Manager</span></div>
                </div>
                <div class="team-member" data-role="Owner">
                    <img src="../FCMS-Assets/images/owner.jpg" alt="Owner">
                    <div class="overlay"><span>Owner</span></div>
                </div>
            </div>
        </div>

        <hr class="separate-dashboard">

        <div class="form-container">
        <h2>Create Employee</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- 'employees' table fields -->
            <label for="employeeName">Employee Name:</label>
            <input type="text" name="employeeName" required>

            <label for="occupation">Occupation:</label>
            <input type="text" name="occupation" required>

            <label for="rates">Rates:</label>
            <input type="text" name="rates" required>

            <label for="weeklyHours">Weekly Hours:</label>
            <input type="text" name="weeklyHours" required>

            <label for="tasksCompleted">Tasks Completed:</label>
            <input type="text" name="tasksCompleted" required>

            <input type="submit" name="submit" value="Submit">
        </form>

        <!-- Display success or error messages here -->
        <?php
        if (!empty($successMessage)) {
            echo '<p class="success-message">' . $successMessage . '</p>';
        }

        if (!empty($errorMessage)) {
            echo '<p class="error-message">' . $errorMessage . '</p>';
        }
        ?>
    </div>


    </div>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";  // Replace with your database password
    $dbname = "fcms";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Define variables to hold success and error messages
    $successMessage = $errorMessage = '';

    // Form submission handling
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Insert into 'employees' table
        $employeeName = $_POST['employeeName'];
        $occupation = $_POST['occupation'];
        $rates = $_POST['rates'];
        $weeklyHours = $_POST['weeklyHours'];
        $tasksCompleted = $_POST['tasksCompleted'];

        $employeeInsertQuery = "INSERT INTO employees (EmployeeName, Occupation, Rates, weekly_hours, tasks_completed) VALUES ('$employeeName', '$occupation', '$rates', '$weeklyHours', '$tasksCompleted')";
        $employeeResult = $conn->query($employeeInsertQuery);

        if ($employeeResult) {
            $successMessage .= "Employee record added successfully!<br>";
        } else {
            $errorMessage .= "Error inserting into 'employees' table: " . $conn->error . "<br>";
        }
    }

    // Close the database connection
    $conn->close();
    ?>

</body>
</html>
