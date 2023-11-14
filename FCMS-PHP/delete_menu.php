<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "FCMS";

// Create a connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the menuId from the URL
if (isset($_GET['menuId'])) {
    $menuIdToDelete = $_GET['menuId'];

    // Fetch existing file path and menu order
    $sqlFetchData = "SELECT file_path FROM menus WHERE MenuID = $menuIdToDelete";
    $resultData = $conn->query($sqlFetchData);

    if ($resultData->num_rows > 0) {
        $rowData = $resultData->fetch_assoc();
        $existingFilePath = $rowData['file_path'];

        // Delete the menu from the database
        $sqlDeleteMenu = "DELETE FROM menus WHERE MenuID = $menuIdToDelete";
        if ($conn->query($sqlDeleteMenu) === TRUE) {
            // Delete the associated image file
            if (unlink($existingFilePath)) {
                // Fetch all menus from the database
                $sqlFetchAllMenus = "SELECT MenuID, file_path FROM menus ORDER BY MenuID";
                $resultAllMenus = $conn->query($sqlFetchAllMenus);

                $menuData = [];
                while ($rowAllMenus = $resultAllMenus->fetch_assoc()) {
                    $menuData[] = $rowAllMenus;
                }

                // Update the remaining menu IDs and file names to maintain order starting from 1
                foreach ($menuData as $index => $menu) {
                    $newMenuId = $index + 1; // Increment by 1 to start from 1
                    $oldMenuId = $menu['MenuID'];

                    // Update the database with the new menu ID
                    $sqlUpdateOrder = "UPDATE menus SET MenuID = $newMenuId WHERE MenuID = $oldMenuId";
                    $conn->query($sqlUpdateOrder);
                }

                // Redirect to the menu page or any other desired location
                header('Location: ../FCMS-PHP/manageMenu.php');
                exit();
            } else {
                echo "Error deleting image file.";
            }
        } else {
            echo "Error deleting menu: " . $conn->error;
        }
    } else {
        echo "Error fetching data.";
    }

    // Free the result sets
    $resultData->free();
}

// Close the database connection
$conn->close();
?>
