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


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_id = $_POST['course_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $seats = $_POST['seats'];

    $stmt = $conn->prepare("INSERT INTO courses (course_id, title, description, duration, seats) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssi", $course_id, $title, $description, $duration, $seats);

    if ($stmt->execute()) {
        echo "Course added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
