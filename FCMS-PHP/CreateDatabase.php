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

// Create a new database (if it doesn't exist)
$databaseName = "FCMS"; 
$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $databaseName";

if (mysqli_query($conn, $createDatabaseQuery)) {
    echo "Database created successfully or already exists.\n";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "\n";
}

// Connect to the newly created database
mysqli_select_db($conn, $databaseName);

// Create a new table within the database (if it doesn't exist)
$tableName = "Users";   // Replace with your desired table name
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

// Create a new table within the database (if it doesn't exist)
$tableName = "Customers";   // Replace with your desired table name
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS $tableName (
        UserId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Firstname VARCHAR(255) NOT NULL,
        Lastname VARCHAR(255) NOT NULL,
        Email VARCHAR(255) NOT NULL,
        Phone INT(255) NOT NULL,
        Address VARCHAR(255) NOT NULL,
	    City VARCHAR(255) NOT NULL,
        Postcode VARCHAR(255) NOT NULL,
        LastOrder VARCHAR(255) NOT NULL,
	    NumberOfOrders VARCHAR (255) NOT NULL,
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
