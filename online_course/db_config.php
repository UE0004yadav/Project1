<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "course_registration";
$port = "3307";

$conn = new mysqli($host, $user, $pass, $db, $port);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
