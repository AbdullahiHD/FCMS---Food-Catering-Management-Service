# FCMS---Food-Catering-Management-Service
Food and Beverage Catering Management System
Overview
This is a web-based catering management system developed using HTML, CSS, JavaScript, and PHP. The system utilizes XAMPP for the local development environment and PHPMyAdmin for the database.

Features
User Authentication: Secure login and registration system.
Menu Management: Add, edit, and delete food and beverage items.
Order Processing: Place and manage customer orders.
Database: Utilizes XAMPP with PHPMyAdmin for the backend database.
Setup
Prerequisites
XAMPP installed.
Git for cloning the repository.
Installation
Clone the repository:

bash
Copy code
git clone https://github.com/your-username/your-repository.git
Import the database:

Open XAMPP and start the Apache and MySQL services.
Access PHPMyAdmin from your browser (typically http://localhost/phpmyadmin).
Create a new database and import the SQL file provided in the database folder.
Configure Database Connection:

Open config.php in the includes folder.
Update the database connection details.
php
Copy code
// Database configuration
$dbHost     = "localhost";
$dbUsername = "your_username";
$dbPassword = "your_password";
$dbName     = "your_database_name";
Run the Application:

Open your browser and navigate to the project folder.
Usage
Register a new user or log in with existing credentials.
Explore the menu and add items to the cart.
Place an order and view order history.
And more.
