<?php
include '../includes/db_connect.php';
session_start();
$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT c.title, c.duration, c.course_id
    FROM courses c
    JOIN registrations r ON c.course_id = r.course_id
    WHERE r.user_id = $user_id");

echo "<h2>Your Registered Courses</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<div><strong>{$row['title']}</strong> - {$row['duration']} (ID: {$row['course_id']})</div>";
}
?>
