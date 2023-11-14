<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Menu</title>
    <link rel="stylesheet" href="../FCMS-Assets/Main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Include jQuery UI Datepicker styles -->
    <!-- Include jQuery UI Datepicker styles -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <!-- Include jQuery and jQuery UI libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <style>
        /* Additional CSS for this specific page */
        body {
            display:flex;
            align-items: center;
            flex-direction: column;
            min-height:100vh;
            margin: 0;
            padding: 0;
            background-image: url(../FCMS-Assets/images/hero-slider-1.jpg);
        }

        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&display=swap");

        .footer {
        margin-top: 20px;
        position: relative;
        width: 100%;
        background: #000000;
        min-height: 100px;
        padding: 20px 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        }

        .social-icon,
        .menu {
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 10px 0;
        flex-wrap: wrap;
        }

        .social-icon__item,
        .menu__item {
        list-style: none;
        }

        .social-icon__link {
        font-size: 2rem;
        color: #fff;
        margin: 0 10px;
        display: inline-block;
        transition: 0.5s;
        }
        .social-icon__link:hover {
        transform: translateY(-10px);
        }

        .menu__link {
        font-size: 1.2rem;
        color: #fff;
        margin: 0 10px;
        display: inline-block;
        transition: 0.5s;
        text-decoration: none;
        opacity: 0.75;
        font-weight: 300;
        }

        .menu__link:hover {
        opacity: 1;
        }

        .footer p {
        color: #fff;
        margin: 15px 0 10px 0;
        font-size: 1rem;
        font-weight: 300;
        }

        
        .form-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 100px;
            width: calc(40% - 10px);
            padding: 30px;
            border: 2px solid #FFD100;
            border-radius: 15px;
            background-color: black;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            width: 100%;
            
        }
        /* Style for the buttons container */
        .button-container {
            display: flex;
            justify-content: space-between; /* Align buttons to the left and right */
            width: 100%;
            margin-top: 10px; /* Add some margin to separate from the form inputs */
        }

        /* Style for the buttons */
        button {
            padding: 10px 20px;
            font-size: 18px;
            background-color: #FFD100;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 5px;
            margin-bottom: 5px;
            width: calc(33% - 10px); 
        }

        .go-back,
        .delete-menu,
        .update-menu {
            max-width: 146px;
        }
        .delete-menu{
            background-color: #EE4B2B;
            color: #fff;
        }
        .delete-menu:hover {
            background-color: #EE4B2B;
            color: #fff;
        }
        label {
            margin-bottom: 5px;
            color: #FFD100;
            font-family: 'Helvetica Neue', sans-serif;
            font-size: 18px;
            font-weight: bold;
            text-align: left;
            width: 50%;
        }

        input[type="text"],
        input[type="number"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }

        input[type="file"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: calc(50% - 10px);
        }
        
        @media screen and (max-width: 768px) {}

        
        .image-placeholder {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 300px;
            height: 300px;
            border: 2px solid #FFD100;
            border-radius: 15px;
            margin: 0 auto;
            margin-bottom: 10px;
        }

        .image-placeholder img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ensure the image covers the container */
            border-radius: 15px;
        }        
    </style>
</head>

<body class="">

    <nav>
    
        <a href="#" class="logolink">
          <img src="../FCMS-Assets/images/culinarycue.png" width="100" height="60" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="../FCMS-HTML/TahaIndex.html">Home</a></li>
            <li><a href="../FCMS-PHP/menu.php">Menu</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">About</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">Our Team</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">Contact</a></li>
            
        </ul>
    
    
    </nav>

    <div class="form-container">
        <h1>Edit Menu</h1>

        <div class="image-placeholder">
            <img id="menu-preview" img src="placeholder.jpg" alt="Menu-Image">
        </div>

        <?php
        // Check if menuId is set in the URL
        if (isset($_GET['menuId'])) {
            // Get the menuId from the URL
            $menuId = $_GET['menuId'];

            // Assuming you have a database connection
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

            // Fetch menu details based on menuId
            $sql = "SELECT * FROM menus WHERE MenuID = $menuId";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // Assign values to variables
                $MenuID = $row['MenuID'];
                $MenuName = $row['MenuName'];
                $menu_price = $row['Price'];
                $appetizer = $row['Appetizer'];
                $mainDish = $row['MainDish'];
                $dessert = $row['Dessert'];
                $drink = $row['Drink'];
                $existingFilePath = $row['file_path'];

                // Close the database connection
                $conn->close();
            }
        }
        ?>

        <form method="post" action="../FCMS-PHP/update_menu.php" enctype="multipart/form-data">
            <!-- Add a hidden input field to store the menu ID -->
            <input type="hidden" name="menuId" id="menuId" value="<?php echo $MenuID; ?>">

            <label for="name">Menu Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $MenuName; ?>" required>

            <label for="menu-price">Menu Price:</label>
            <input type="number" id="menu-price" name="menu-price" value="<?php echo $menu_price; ?>" required>

            <label for="menu-app">Appetiser:</label>
            <input type="text" id="menu-app" name="menu-app" value="<?php echo $appetizer; ?>" required>

            <label for="menu-main">Main Dish:</label>
            <input type="text" id="menu-main" name="menu-main" value="<?php echo $mainDish; ?>" required>

            <label for="menu-des">Dessert:</label>
            <input type="text" id="menu-des" name="menu-des" value="<?php echo $dessert; ?>" required>

            <label for="menu-drink">Drink:</label>
            <input type="text" id="menu-drink" name="menu-drink" value="<?php echo $drink; ?>" required>

            <!-- Add a hidden input field to store the existing file path -->
            <input type="hidden" name="existingFilePath" value="<?php echo $existingFilePath; ?>">

            <label for="file_path">Upload Menu Image:</label>
            <input type="file" id="file" name="file" accept="image/*">

            <div class="button-container">
                <button type="button" class="go-back" onclick="goBack()">Go Back</button>
                <button type="submit" value="Submit" name="submit" class="update-menu">Update Menu</button>
                <button type="button" class="delete-menu" onclick="deleteMenu()">Delete Menu</button>
            </div>
        </form>
    </div>



    <footer class="footer">
        <ul class="social-icon">
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-facebook"></ion-icon>
            </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-twitter"></ion-icon>
            </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-linkedin"></ion-icon>
            </a></li>
            <li class="social-icon__item"><a class="social-icon__link" href="#">
                <ion-icon name="logo-instagram"></ion-icon>
            </a></li>
        </ul>
        <ul class="menu">
            <li class="menu__item"><a class="menu__link" href="#homenav">Home</a></li>
            <li class="menu__item"><a class="menu__link" href="#NavMenu">Menu</a></li>
            <li class="menu__item"><a class="menu__link" href="#Navabout">About</a></li>
            <li class="menu__item"><a class="menu__link" href="#Navteam">Our Team</a></li>
            <li class="menu__item"><a class="menu__link" href="#Navcontact">Contact</a></li>
        </ul>
        
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        function goBack() {
            window.location.href = 'manageMenu.php';
        }
        const existingFilePath = "<?php echo $existingFilePath; ?>";
        const menuPreview = document.getElementById("menu-preview");
        menuPreview.src = "<?php echo $existingFilePath; ?>";

        
        // Get the file input element
        const menuImageInput = document.getElementById("file");
    
        // Add an event listener to the file input
        menuImageInput.addEventListener("change", function(event) {
            // Get the selected file from the input
            const file = event.target.files[0];
    
            // Check if a file was selected
            if (file) {
                // Create a FileReader to read the selected file
                const reader = new FileReader();
    
                // Set up the FileReader onload event
                reader.onload = function(e) {
                    // Update the image preview src with the data URL of the selected file
                    menuPreview.src = e.target.result;
                };
    
                // Read the selected file as a data URL
                reader.readAsDataURL(file);
            } else {
                // If no file is selected, revert back to the default placeholder image
                menuPreview.src = "placeholder.jpg";
            }
        });
        // Function to delete the menu
        function deleteMenu() {
            if (confirm("Are you sure you want to delete this menu?")) {
                // Redirect to delete_menu.php with the menuId
                window.location.href = "../FCMS-PHP/delete_menu.php?menuId=<?php echo $MenuID; ?>";
            }
        }
    </script>
</body>
</html>