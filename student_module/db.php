<?php 
// Step 1: Database Configuration
$host = "localhost";
$username = "root";
$password = ""; 
$database = "registration_system"; 
$port = 3307; 

// Step 2: Create the connection
$conn = new mysqli($host, $username, $password, $database, $port);
// Step 3: Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}else{
    //echo "Database is connected successfuly";

}
?>