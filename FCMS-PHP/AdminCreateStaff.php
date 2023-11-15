<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../FCMS-CSS/AdminCreateStaff.css">
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <title>Create Staff</title>
    <!-- Link to navbar css -->
    <link rel="stylesheet" href="../FCMS-CSS/AdminNav.css">
    <style>
        nav ul {
            margin-left: 150px;
            background-color: rgb(11, 11, 10);
        }

        nav ul li {
            list-style-type: none;
            display: inline-block;
            padding: 10px 70px;
            background-color: rgb(11, 11, 10);
        }

        nav ul li a {
            color: goldenrod;
            text-decoration: none;
            font-family: 'Franklin Gothic Medium', sans-serif;
            font-weight: bold;
            text-transform: capitalize;
            font-size: 17px;

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

        .dropdown .dropbtn {
            font-size: 20px;
            color: goldenrod;
            text-decoration: none;
            font-family: 'Franklin Gothic Medium', sans-serif;
            font-weight: bold;
            text-transform: capitalize;
            font-size: 17px;
            background-color: rgb(11, 11, 10);
            position: relative;
            margin-right: 400px;
        }

        .dropdown .dropbtn::before,
        .dropdown .dropbtn::after {
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


        .dropdown .dropbtn::before {
            bottom: 1px;
            /* Slight offset from the bottom to create gap between two lines */
        }

        /* Second line appears from the right */
        .dropdown .dropbtn::after {
            bottom: -3px;
            /* Slight offset from the bottom */
            right: 0;
            left: auto;
            transform: scaleX(-1);
            /* Invert it to make it appear from right */
        }

        /* On hover, the lines animate to full width */
        .dropdown .dropbtn:hover::before,
        .dropdown .dropbtn:hover::after {
            width: 100%;
        }
    </style>
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
        // Insert into 'users' table
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $userInsertQuery = "INSERT INTO users (Username, Password, Permission) VALUES ('$username', '$password', 'Staff')";
        $userResult = $conn->query($userInsertQuery);

        if ($userResult) {
            // Get the generated User ID
            $userId = $conn->insert_id;

            // Insert into 'staff' table
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $joiningDate = $_POST['joiningDate'];
            $position = $_POST['position'];

            // File upload handling for 'image'
            $targetDirectory = "uploads/";  // Change this to your desired directory
            $targetFile = $targetDirectory . basename($_FILES["image"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"])) {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $errorMessage .= "File is not an image.<br>";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($targetFile)) {
                $errorMessage .= "Sorry, file already exists.<br>";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["image"]["size"] > 50000000) {
                $errorMessage .= "Sorry, your file is too large.<br>";
                $uploadOk = 0;
            }

            // Allow certain file formats
            $allowedFileFormats = ["jpg", "png", "jpeg", "gif"];
            if (!in_array($imageFileType, $allowedFileFormats)) {
                $errorMessage .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                $errorMessage .= "Sorry, your file was not uploaded.<br>";
            } else {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                    $successMessage .= "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.<br>";
                } else {
                    $errorMessage .= "Sorry, there was an error uploading your file.<br>";
                }
            }

            $imagePath = $targetFile;

            $staffInsertQuery = "INSERT INTO staff (UserId, FirstName, LastName, JoiningDate, Position, Image) VALUES ('$userId', '$firstName', '$lastName', '$joiningDate', '$position', '$imagePath')";
            $staffResult = $conn->query($staffInsertQuery);

            if ($staffResult) {
                $successMessage .= "Staff record added successfully!<br>";
            } else {
                $errorMessage .= "Error inserting into 'staff' table: " . $conn->error . "<br>";
            }
        } else {
            $errorMessage .= "Error inserting into 'users' table: " . $conn->error . "<br>";
        }
    }

    // Close the database connection
    $conn->close();
    ?>

    <nav>
        <a href="../FCMS-HTML/TahaIndex.html" class="logolink">
            <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="../FCMS-HTML/Dashboard.html">Dashboard</a></li>
            <li><a href="../FCMS-PHP/EventManagement.php">Events</a></li>
            <li><a href="../FCMS-PHP/manageMenu.php">Menu</a></li>
            <li><a href="../FCMS-PHP/AdminCreateStaff.php">Staff</a></li>

        </ul>
        <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Statistics</button>
            <div id="myDropdown" class="dropdown-content">
                <li><a href="../FCMS-PHP/StaffStatistic.php">Staff</a></li>
                <li><a href="../FCMS-PHP/OrderStatistic.php">Orders</a></li>
                <li><a href="../FCMS-PHP/CustomerStatistics.php">Customers</a></li>
                <li><a href="../FCMS-PHP/RevenueStatistic.php">Profits</a></li>
            </div>
        </div>

        <script>
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }

            window.onclick = function(event) {
                if (!event.target.matches('.dropbtn')) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }
        </script>
    </nav>

    <div class="form-container">
        <h2>Create Staff</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
            <!-- 'users' table fields -->
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <!-- 'staff' table fields -->
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" required>

            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" required>

            <label for="joiningDate">Joining Date:</label>
            <input type="date" name="joiningDate" required>

            <label for="position">Position:</label>
            <input type="text" name="position" required>

            <label for="image">Image:</label>
            <input type="file" name="image" id="image" required>

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