<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FCMS-CSS/StaffCreateEmployee.css">
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <title>Create Employee</title>
    <!-- Link to navbar css -->
    <link rel="stylesheet" href="../FCMS-CSS/StaffNav.css">
</head>

<body>

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

        $employeeInsertQuery = "INSERT INTO employees (EmployeeName, Occupation, Rates, WeeklyHours, TasksCompleted) VALUES ('$employeeName', '$occupation', '$rates', '$weeklyHours', '$tasksCompleted')";
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

    <div id="header">
        <h1>Create Employee</h1>
    </div>
    <div class="navbar">
        <ul>
            <!-- Add your navigation links here -->
            <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="../FCMS-PHP/EventManagement.php">Events</a></li>
            <li><a href="../FCMS-PHP/manageMenu.php">Menu</a></li>
            <li><a href="../FCMS-PHP/AdminCreateStaff.php">Staff</a></li>

            <!-- Add dropdown if needed -->

        </ul>
    </div>

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

</body>

</html>
