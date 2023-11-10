<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "FCMS";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'], $_POST['menu-price'], $_POST['menu-app'], $_POST['menu-main'], $_POST['menu-des'], $_POST['menu-drink'])) {
        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $menuName = $conn->real_escape_string($_POST["name"]);
        $price = $conn->real_escape_string($_POST["menu-price"]);
        $appetizer = $conn->real_escape_string($_POST["menu-app"]);
        $mainDish = $conn->real_escape_string($_POST["menu-main"]);
        $dessert = $conn->real_escape_string($_POST["menu-des"]);
        $drink = $conn->real_escape_string($_POST["menu-drink"]);
        // Validate input (example: ensure price is a valid numeric value)
        if (!is_numeric($price)) {
            echo "Invalid price input.";
            $conn->close();
            exit();
        }

        $sqlCountRows = "SELECT COUNT(*) as total FROM menus";
        $result = $conn->query($sqlCountRows);

        if ($result) {
            $row = $result->fetch_assoc();
            $menuId = isset($row["total"]) ? $row["total"] + 1 : 1;
            $result->free();
        } else {
            echo "Error: Unable to fetch menu count.";
            $conn->close();
            exit();
        }

        $sql = "INSERT INTO menus (MenuID, MenuName, Appetizer, MainDish, Dessert, Drink, Price) 
                VALUES ('$menuId', '$menuName', '$appetizer', '$mainDish', '$dessert', '$drink', '$price')";

        if ($conn->query($sql) === TRUE) {
            echo"errpr";
        } else {
            echo "Error: Unable to add menu. Please try again later.";
            // Log detailed error for your reference: echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    } else {
        echo "Missing required parameters.";
    }
?>
