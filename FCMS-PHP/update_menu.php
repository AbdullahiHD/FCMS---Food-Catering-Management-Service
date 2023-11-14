<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "FCMS";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $databaseName);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $menuId = $_POST['menuId'];
    $menuName = $_POST['name'];
    $menuPrice = $_POST['menu-price'];
    $appetizer = $_POST['menu-app'];
    $mainDish = $_POST['menu-main'];
    $dessert = $_POST['menu-des'];
    $drink = $_POST['menu-drink'];
    $existingFilePath = $_POST['existingFilePath'];

    // Check if a file was uploaded
    $fileDestination = $existingFilePath;

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
        $uniqueId = uniqid(); // Generate a unique identifier
        if (in_array($fileActualExt, $allowed)) {
            if ($fileError === 0) {
                if ($fileSize < 10000000) {
                    // Delete existing file
                    if (file_exists($existingFilePath)) {
                        if (!unlink($existingFilePath)) {
                            die("Error deleting existing file.");
                        }
                    }

                    $fileNameNew = 'menu_' . $uniqueId . '.' . $fileActualExt;
                    $fileDestination = 'uploads/' . $fileNameNew;
                    if (!move_uploaded_file($fileTmpName, $fileDestination)) {
                        die("Error uploading file.");
                    }
                } else {
                    die("Your file is too big.");
                }
            } else {
                die("There was an error uploading your file.");
            }
        } else {
            die("You cannot upload files of this type.");
        }
    }

    // Update the database with the new values
    $sql = "UPDATE menus SET MenuName = '$menuName', Price = $menuPrice, 
            Appetizer = '$appetizer', MainDish = '$mainDish', 
            Dessert = '$dessert', Drink = '$drink', 
            file_path = '$fileDestination' WHERE MenuID = $menuId";

    if ($conn->query($sql) === TRUE) {
        echo "Menu updated successfully";
        header('Location: manageMenu.php');
    } else {
        echo "Error updating menu: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
