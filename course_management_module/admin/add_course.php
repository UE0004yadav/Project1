<?php
// to showing the error
error_reporting(E_ALL);
ini_set('display_errors', 1);
// 1. Database configuration
$host = "localhost";
$username = "root";
$password = "";
$dbname = "register";
$port = "3307";

// 2. Create connection
$conn = new mysqli($host, $username, $password, $dbname, $port);

// 3. Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// 4. Get and sanitize form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = trim ( $_POST['course_id']);
    $title = trim ($_POST['title']);
    $description = trim ($_POST['description']);
    $duration = trim ($_POST['duration']);
    $seats = trim($_POST['seats']);
    // 5. Use prepared statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO courses (course_id, title, description, duration, seats) VALUES (?, ?, ?, ?, ?)");
     if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
       }

    //6. Bind parameters correctly (5values) 
     $stmt->bind_param("ssssi", $course_id, $title, $description, $duration, $seats);

    // 7. Execute and check success
    if ($stmt->execute()) {
        echo "Course added successfully.";
    } else {
       echo "Error executing: ". $stmt->error;

    }
    $stmt->close();
   } 

// 7. Close connections

$conn->close();

?>

