<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimonials</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif, sans-serif;
            background-color: #f3f3f3;
            margin-top: 80px;
            padding: 0;
        }

        .container {
            width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #202020;
            border-radius: 5px;
        }

        h1 {
            text-align: center;
            color: goldenrod;
            margin-top: 80px;
        }

        h2 {
            text-align: center;
            color: goldenrod;
            margin-top: 30px;
        }

        .testimonials {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
        }

        .testimonial {
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .testimonial p {
            font-size: 18px;
            text-align: center;
            color: #555;
        }

        .author {
            text-align: right;
            font-weight: bold;
            color: #777;
            margin-top: 10px;
        }

        .author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
            object-fit: cover;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: #202020;
            margin-bottom: 40px;

        }

        .content {
            margin-left: 220px;
            padding: 20px;
            color: white;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 0px;
            padding-bottom: 0px;
            padding-left: 8%;
            padding-right: 8%;
            background-color: rgb(11, 11, 10);
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        nav ul li {
            list-style-type: none;
            display: inline-block;
            padding: 10px 25px;
        }

        nav ul li a {
            color: goldenrod;
            text-decoration: none;
            font-family: 'Franklin Gothic Medium', sans-serif;
            font-weight: bold;
            text-transform: capitalize;
            font-size: 17px;
        }

        .registrationbutton {
            background-color: goldenrod;
            color: white;
            font-family: 'Franklin Gothic Medium', sans-serif;
            text-decoration: none;
            border: 2px dotted transparent;
            font-weight: bold;
            padding: 10px 25px;
            border-radius: 40px;
            transition: transform .3s;
        }

        .registrationbutton:hover {
            transform: scale(1.1);
        }

        nav ul li a {
            position: relative;
        }

        nav ul li a::before,
        nav ul li a::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: goldenrod;
            transition: all 0.3s ease;
        }

        nav ul li a::before {
            bottom: 1px;
        }

        nav ul li a::after {
            bottom: -3px;
            right: 0;
            left: auto;
            transform: scaleX(-1);
        }

        nav ul li a:hover::before,
        nav ul li a:hover::after {
            width: 100%;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        button {
            background-color: goldenrod;
            color: black;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: gold;
        }
    </style>
</head>
<body>
<div class="container">
        <h1>Thank You For Your Feedback</h1>
        <h2>What Our Customers Are Saying...</h2>
        <div class="testimonials">

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

            // Fetch comments from the database
            $sql = "SELECT Comments, CustomerName FROM requests";
            $result = $conn->query($sql);

            // Output testimonials dynamically
            while ($row = $result->fetch_assoc()) {
                echo '<div class="testimonial">';
                echo '<p>"' . $row['Comments'] . '"</p>';
                echo '<div class="author">';
                echo '<p>"' . $row['CustomerName'] . '"</p>';
                echo '</div>';
                echo '</div>';
            }

            // Close the database connection
            $conn->close();
            ?>

        </div>
    </div>
    <div class="button-container">
        <a href="../FCMS-HTML/TahaIndex.html">
            <button>Home Page</button>
        </a>
    </div>
    <nav>
        <a href="#" class="logolink">
        <img src="../FCMS-Assets/images/culinarycue.png" width="100px" height="60px" alt="CulinaryCue - Home">
        </a>
        <ul>
            <li><a href="../FCMS-HTML/TahaIndex.html">Home</a></li>
            <li><a href="../FCMS-PHP/menu.php">Menu</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">About</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">Our Team</a></li>
            <li><a href="../FCMS-HTML/TahaIndex.html">Contact</a></li>
        </ul>
        <a href="" class="registrationbutton">Login</a>
        
    </nav>
</body>
</html>
