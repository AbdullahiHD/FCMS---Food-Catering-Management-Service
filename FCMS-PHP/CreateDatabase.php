<?php
// Database configuration
$servername = "localhost";  
$username = "root";
$password = "";
$databaseName = "FCMS";


// Connect to MySQL server
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create a FCMS database 
$databaseName = "FCMS"; 
$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $databaseName";

if (mysqli_query($conn, $createDatabaseQuery)) {
    echo "Database created successfully or already exists.\n";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "\n";
}

// Connect to the newly created database
mysqli_select_db($conn, $databaseName);

// Creating a users table
$tableName = "Users";  
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS $tableName (
        UserId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Username VARCHAR(255) NOT NULL,
        Email VARCHAR(255) NOT NULL,
        Password VARCHAR(255) NOT NULL,
        Permission VARCHAR(255),
        CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        DeletedAt TIMESTAMP NULL
   
    )
";


if (mysqli_query($conn, $createTableQuery)) {
    echo "\nTable created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

// Creating an Orders table 
$tableName = "Orders";
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS $tableName (
        OrderID INT AUTO_INCREMENT PRIMARY KEY,
        CustomerName VARCHAR(255),
        EventTime TIME,
        EventDate DATETIME,
        DeliveryAddress VARCHAR(255),
        NumberOfAttendees INT,
        MenuID INT,
        OrderStatus VARCHAR(255),
        CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        DeletedAt TIMESTAMP NULL
       
    )
";

if (mysqli_query($conn, $createTableQuery)) {
    echo "\nTable created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

// Creating an Orders table 
$tableName = "Requests";
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS $tableName (
        RequestID INT AUTO_INCREMENT PRIMARY KEY,
        CustomerName VARCHAR(255),
        EventTime TIME,
        EventDate DATETIME,
        DeliveryAddress VARCHAR(255),
        NumberOfAttendees INT,
        MenuID INT,
        RequestStatus VARCHAR(255),
        PaymentStatus VARCHAR(255),
        CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        DeletedAt TIMESTAMP NULL
       
    )
";

if (mysqli_query($conn, $createTableQuery)) {
    echo "\nTable created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}



// Close the database connection
mysqli_close($conn);
?>
