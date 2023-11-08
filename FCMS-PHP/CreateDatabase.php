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

// Creating a users table
$tableName = "Customers";  
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS $tableName (
    CustomerId INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    Firstname VARCHAR(255) NOT NULL,
    Lastname VARCHAR(255) NOT NULL,
    Email VARCHAR(255) NOT NULL,
    Phone VARCHAR(255) NOT NULL,
    Street VARCHAR(255) NOT NULL,
    City VARCHAR(255) NOT NULL,
    State VARCHAR(255) NOT NULL,
    Postcode VARCHAR(255) NOT NULL,
    LastOrder VARCHAR(255) NOT NULL,
    NumberOfOrders VARCHAR(255) NOT NULL,
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

// Creating an Requests table 
$tableName = "Requests";
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS $tableName (
        RequestID INT AUTO_INCREMENT PRIMARY KEY,
        CustomerName VARCHAR(255),
        EventTime TIME,
        EventDate DATE,
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

// Creating an Menus table 
$tableName = "Menus";
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS $tableName (
        MenuID INT AUTO_INCREMENT PRIMARY KEY,
        MenuName VARCHAR(255),
        Appetizer VARCHAR(255) NOT NULL,
        MainDish VARCHAR(255) NOT NULL,
        Dessert VARCHAR(255) NOT NULL,
        Drink VARCHAR(255) NOT NULL,
        Price INT NOT NULL,
        AddedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        UpdatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        DeletedAt TIMESTAMP NULL
       
    )
";

if (mysqli_query($conn, $createTableQuery)) {
    echo "\nTable created successfully.\n";
} else {
    echo "Error creating table: " . mysqli_error($conn) . "\n";
}

// Creating an Sales table 
$tableName = "Sales";
$createTableQuery = "
    CREATE TABLE IF NOT EXISTS $tableName (
        PaymentID INT AUTO_INCREMENT PRIMARY KEY,
        CustomerName VARCHAR(255),
        OrderID INT(255) NOT NULL,
        MenuID INT(255) NOT NULL,
        MenuName VARCHAR(255) NOT NULL,
        UnitPrice INT(255) NOT NULL,
        TotalPrice INT(255) NOT NULL,
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
