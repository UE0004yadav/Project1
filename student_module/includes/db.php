<?php
// Show all errors while developing (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database configuration
$host = "localhost";
$username = "root";
$password = ""; // XAMPP default is blank
$dbname = "registration_system"; // Change this to your actual database name
$port = "3307"; // Default for XAMPP (might be 3306 for some setups)

// Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
