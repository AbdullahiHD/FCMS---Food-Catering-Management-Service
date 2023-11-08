<?php
    // Connect to the MySQL database 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "FCMS";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['MenuId'], $_POST['MenuName'], $_POST['Appetizer'], $_POST['MainDish'], $_POST['Dessert'], $_POST['Drink'], $_POST['Price'])) {

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve form data
        $menuName = $conn->real_escape_string($_POST["name"]);
        $appetizer = $conn->real_escape_string($_POST["menu-app"]);
        $mainDish = $conn->real_escape_string($_POST["menu-main"]);
        $dessert = $conn->real_escape_string($_POST["menu-des"]);
        $drink = $conn->real_escape_string($_POST["menu-drink"]);
        $price = $conn->real_escape_string($_POST["menu-price"]);

        // Calculate menuId
        $sqlCountRows = "SELECT COUNT(*) as total FROM menus";
        $result = $conn->query($sqlCountRows);
        $row = $result->fetch_assoc();
        $menuId = $row["total"] + 1;

        // Insert data into the menu table
        $sql = "INSERT INTO menus (MenuID, MenuName, Appetizer, MainDish, Dessert, Drink, Price) VALUES ('$menuId', '$menuName', '$appetizer', '$mainDish', '$dessert', '$drink', '$price')";

        if ($conn->query($sql) === TRUE) {
            // Return success message with menuID as response
            echo "Menu added successfully with menuID: " . $menuId;
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