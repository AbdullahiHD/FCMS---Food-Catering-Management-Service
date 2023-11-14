<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
    $menuId = 0;

    // Your existing code to fetch menu ID...
    $sqlCountRows = "SELECT COUNT(*) as total FROM menus";
    $result = $conn->query($sqlCountRows);

    if ($result) {
        $row = $result->fetch_assoc();
        $menuId = $row['total'] + 1;
    } else {
        echo "Error: Unable to fetch menu count. Please try again later.";
    }
    $result->free();

    // Check if a file was uploaded
    $fileDestination = '';

    if (isset($_FILES['file']) && $_FILES['file']['error'] === 0) {
        $file = $_FILES['file'];

        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg', 'jpeg', 'png');

        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 10000000) {
                    $uniqueId = uniqid(); // Generate a unique identifier
                    $fileNameNew = 'menu_' . $uniqueId . '.' . $fileActualExt;
                    $fileDestination = 'uploads/' . $fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                } else {
                    echo "Your file is too big.";
                }
            } else {
                echo "There was an error uploading your file.";
            }
        } else {
            echo "You cannot upload files of this type.";
        }
    }

    // Check if file was successfully uploaded before inserting into the database
    if (!empty($fileDestination)) {
        // Your existing code to insert into the database...
        $sql = "INSERT INTO menus (MenuID, MenuName, Appetizer, MainDish, Dessert, Drink, Price, file_path) 
                VALUES ('$menuId', '$menuName', '$appetizer', '$mainDish', '$dessert', '$drink', '$price', '$fileDestination')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to manageMenu.html
            header('Location: manageMenu.php');
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "File not uploaded successfully. Database insertion skipped.";
    }

    $conn->close();
} else {
    echo "Missing required parameters.";
}
?>
